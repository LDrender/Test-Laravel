
// ----------------------------------------------
// Must be configured by app
// ----------------------------------------------
appName = "mekalink"
appUseSSL = true


devHostName = "srvmekalinkdev.amplitude-ortho.com"
prodHostName = "srvmekalinkprod.amplitude-ortho.com"

dbHost = "db"
dbUser = "mekalinkUser"
dbPassword = "SLXMK6BCCYWWTA3J"
secretFolder = "/var/secret/mekalink"
mysqlPassword = "M3kaL1f0"

appDevLocal = true
appDevIpDev = "192.168.16.29"
appDevIpProd = "192.168.17.66"

dockerFilesDirectory="build"
user="dev"
masterBranch = "main"

// ----------------------------------------------
// Can be configured by app
// ----------------------------------------------

def configuration() {
	return [
		prod: [
			mysql: 3306,
			mysqlDataBase: "mekalink",
			mysqlPassword: mysqlPassword,
			host: prodHostName,
			dockerTag: "prod"
		],
		dev: [
			appDebug: 23181,
			mysql: 3306,
			mysqlDataBase: "mekalink",
			mysqlPassword: mysqlPassword,
			host: devHostName,
			dockerTag: "dev"
		]
	]
}

def pushToEnvironmentSpecific(configuration) {
	
	def environmentToCopy = getEnvironmentToCopy();

	createRemoteDirectory(configuration.ip, "mysql-${configuration.dockerTag}/");

	if (environmentToCopy) {
		def sqlFile = dumpDatabase(environmentToCopy, "${configuration.dbDatabase}", "${dbUser}", "${dockerFilesDirectory}/mysql-${configuration.dockerTag}")
		copyFileToRemote(sqlFile, "~/mysql-${configuration.dockerTag}/", configuration.ip)
	} else {
		copyFileToRemote("./${dockerFilesDirectory}/mysql/init_db.sql", "~/mysql-"+configuration.dockerTag+"/", configuration.ip)
	}
}


// ----------------------------------------------
// Can not be configured by app : Process
// ----------------------------------------------

String cron_string = BRANCH_NAME == masterBranch ? "00 01,13 * * *" : ""

pipeline {
	agent any
	triggers { cron(cron_string) }
	stages {
		
		stage('Deliver') {
			when {
				anyOf {
					branch 'env/*'
					expression { return dailyDeploy() }
					expression { return pullRequestDeploy() }
				}
			}
			steps {				
				deliver()
			}
		}
	}
}

def deliver() {	
	def configuration = currentConfiguration()
	
	fillFilesEnv(configuration)

	fillFilesDocker(configuration)

	copyFileToRemote("docker-compose.yml", "~/docker-compose.yml", configuration.ip)
	copyFileToRemote("build/nginx/app.conf", "~/build/nginx/app.conf", configuration.ip)
	
	preBuildDocker()

	writeFileToRemote(configuration.ip, "clean.${appName}.sh", generateCleanSH(configuration, appName))
	writeFileToRemote(configuration.ip, "clean.${appName}.${configuration.dockerTag}.sh", generateCleanSHTag(configuration, appName))
	
	pushToEnvironmentSpecific(configuration)
				
	copyDockerFile(configuration.dockerTag, configuration.ip)
	
	restartDocker(configuration.ip, configuration.dockerTag)

	
}


// ----------------------------------------------
// Can not be configured by app : helpers
// ----------------------------------------------

// --- Configuration helpers ---

def currentConfiguration() {
	def configurations = configuration()
	def env = environment()
	def configuration = configurations[env]
	if (configuration.ip == null) {
		configuration.ip = getIp(configuration.host)
	}
	if (configuration.mysql == null) {
		configuration.mysql = 0
	}

	configuration.env = env
	return configuration
}


def environment() {
	if (onMasterBranch()) {
		return "master"
	}
	if (pullRequest()) {
		return "pr"
	}
	if (onReleaseBranch()) {
		return "release"
	}
	if (onEnvBranch()) {
		return getEnvironmentName()
	}
	throw new Exception("Impossible to determine environment")
}

def getEnvironmentToCopy() {
	def configurations = configuration()
	for (configuration in configurations) {
		if (pullRequestTitleContainsTag("data:${configuration.key}")) {
			return configuration.value
		}
	}
	def current = currentConfiguration();
	if (current.environmentToCopy) {
		return configurations[current.environmentToCopy]
	}
	return null
}

def pullRequestTitleContainsTag(expectedTag) {
	def changeTitle = "${env.CHANGE_TITLE}"
	expectedTag = expectedTag.toLowerCase()
	return changeTitle.toLowerCase().contains("[${expectedTag}]")
}

def getEnvironmentName() {
	return getSecondPartBranchName();
}

def getSecondPartBranchName() {
	def branchName = "${env.BRANCH_NAME}"
	def (value1, secondPart) = branchName.tokenize( '/' )
	return secondPart;
}

def pullRequest() {
	return env.CHANGE_ID
}

def onReleaseBranch() {
	return env.BRANCH_NAME.startsWith('release/')
}

def onEnvBranch() {
	return env.BRANCH_NAME.startsWith('env/')
}

def onMasterBranch() {
	return env.BRANCH_NAME == masterBranch
}


def pullRequestDeploy() {
	if (pullRequest()) {
		return !pullRequestTitleContainsTag("minor")
	}
	return false
}

def dailyDeploy() {
	def res = false
	currentBuild.rawBuild.getCauses().each {
		if (it.toString().startsWith('hudson.triggers.TimerTrigger')) {
			res = true
		}
	}
	return res
}

// --- Groovy helpers ---

def getIp(hostName) {
	def address = InetAddress.getByName(hostName); 
	return address.getHostAddress();
}


// --- Docker helpers ---

def restartDocker(ip, destEnvName) {

	sh "ssh ${user}@${ip} sudo docker-compose -f docker-compose.yml stop"
	sh "ssh ${user}@${ip} sudo docker-compose -f docker-compose.yml rm --force"
	sh "ssh ${user}@${ip} sudo docker-compose -f docker-compose.yml up -d"
	sh "ssh ${user}@${ip} sudo docker exec mekalink-app php artisan key:generate"
	
}


def copyDockerFile(dockerTag, ip) {
	sh "sudo docker save -o ${appName}-${dockerTag}.img ${appName}:${dockerTag}"
	sh "sudo chmod 755 ${appName}-${dockerTag}.img"
	sh "scp -o StrictHostKeyChecking=no ${appName}-${dockerTag}.img ${user}@${ip}:~/${appName}-${dockerTag}.img"
	sh "ssh ${user}@${ip} sudo docker load -i ${appName}-${dockerTag}.img"
}

def preBuildDocker() {
	sh "sudo docker-compose build app"
}


def fillFilesEnv(configuration) {

	def confAppName = appName+"-"+configuration.dockerTag

	def variables = [
		appName: confAppName,
		dbHost: dbHost,
		dbPort: configuration.mysql,
		dbDatabase: configuration.mysqlDataBase,
		dbUsername: dbUser,
		dbPassword: configuration.mysqlPassword
	]

	//copy Exemple env file for fill next
	sh 'cp .env.example .env'
	
	variables.each { key, val ->
		sh "sed -i 's/{${key}}/${val}/g' .env"
		sh "sed -i 's/${key}/${val}/g' .env"
	}
}

def fillFilesDocker(configuration) {

	def confAppName = appName+":"+configuration.dockerTag

	def variables = [
		dockerTag: configuration.dockerTag,
		appName: confAppName,
		dbPort: configuration.mysql,
		dbDatabase: configuration.mysqlDataBase,
		dbUsername: dbUser,
		dbRootPassword: dbPassword,
		dbPassword: configuration.mysqlPassword
	]
	
	variables.each { key, val ->
		sh "sed -i 's/{${key}}/${val}/g' docker-compose.yml"
		sh "sed -i 's/${key}/${val}/g' docker-compose.yml"
	}
}

// --- Jenkins helpers ---

def writeJenkinsBuildInfos(configuration) {
	def description = "";
	if (appUseSSL) {
		description += """<a href="https://${configuration.host}:${configuration.app}">Accéder à l'application</a><br/>"""
	} else {
		description += """<a href="http://${configuration.ip}:${configuration.app}">Accéder à l'application</a><br/>"""
	}
	if (toInt("" + configuration.mysql) != 0) {
		description += 	"""MySQL : ${configuration.ip}, port : ${configuration.mysql}<br/>"""
	}
	if (toInt("" + configuration.appDebug) != 0) {
		description += 	"""Remote debug : ${configuration.ip}, port : ${configuration.appDebug}<br/>"""
	}
	currentBuild.description = description
}




// --- Database helpers ---

def dumpDatabase(environment, dbName, dbUserName, targetFolder) {
	sh "rm -rf ${targetFolder}"
	sh "mkdir -p ${targetFolder}"
	sh "mysqldump -h${environment.host} --port=${environment.mysql} -u ${dbUserName} -p${environment.mysqlPassword} ${dbName} > ${targetFolder}/${dbName}.sql"
	return "${targetFolder}/${dbName}.sql"
}

// --- Generated files ---


def generateCleanSH(configuration, appName) {
	return """
#!/bin/bash

app=${appName}

if [ "\$#" -ne 1 ]; then
    echo "Usage:"
    echo " - ./clean.\$app.sh dev"
    echo " - ./clean.\$app.sh PR-123"
else
	docker-compose -f app.\$app.\$1.yml stop
	docker-compose -f app.\$app.\$1.yml rm --force
	rm -rf /var/data/\$app/\$1
	docker image prune -a --force
	rm -f app.\$app.\$1.yml
	rm -f \$app-\$1.img
fi



"""
}


def generateCleanSHTag(configuration, appName) {
	return """
#!/bin/bash

./clean.${appName}.sh ${configuration.dockerTag}

"""
}


def generateHeidiSqlFile(configuration) {
	return """Windows Registry Editor Version 5.00

[HKEY_CURRENT_USER\\Software\\HeidiSQL\\Servers\\${appName}]
"SessionCreated"="2018-10-18 11:46:18"
"Folder"=dword:00000001

[HKEY_CURRENT_USER\\Software\\HeidiSQL\\Servers\\${appName}\\${configuration.dockerTag}]
"SessionCreated"="2019-01-18 15:15:29"
"Host"="${configuration.ip}"
"WindowsAuth"=dword:00000000
"User"="${dbUser}"
"Password"="${dbPassword}"
"LoginPrompt"=dword:00000000
"Port"="${configuration.mysql}"
"NetType"=dword:00000000
"Compressed"=dword:00000000
"LocalTimeZone"=dword:00000000
"QueryTimeout"=dword:00000000
"KeepAlive"=dword:00000000
"FullTableStatus"=dword:00000001
"Databases"=""
"Comment"=""
"StartupScriptFilename"=""
"TreeBackground"=dword:1fffffff
"SSHtunnelHost"=""
"SSHtunnelHostPort"=dword:00000000
"SSHtunnelUser"=""
"SSHtunnelPassword"="5"
"SSHtunnelTimeout"=dword:00000004
"SSHtunnelPrivateKey"=""
"SSHtunnelPort"=dword:00000ceb
"SSL_Active"=dword:00000000
"SSL_Key"=""
"SSL_Cert"=""
"SSL_CA"=""
"SSL_Cipher"=""
"ServerVersionFull"="5.7.20 - MySQL Community Server (GPL)"
"ConnectCount"=dword:00000002
"ServerVersion"=dword:0000c620
"LastConnect"="2019-01-21 10:49:23"
"lastUsedDB"="s11"

[HKEY_CURRENT_USER\\Software\\HeidiSQL\\Servers\\${appName}\\${configuration.dockerTag}\\QueryHistory]

"""
}


// --- File helpers ---

def copyFileToRemote(localFileName, remoteFileName, ip) {
	sh "scp -o StrictHostKeyChecking=no ${localFileName} ${user}@${ip}:${remoteFileName}"
}

def writeFileToRemote(ip, remoteFilePath, content) {
	writeFile file: "${dockerFilesDirectory}/temp.txt", text: content
	sh "scp ${dockerFilesDirectory}/temp.txt ${user}@${ip}:${remoteFilePath}"
	sh "ssh ${user}@${ip} chmod 777 ${remoteFilePath}"
}

def findRemoteDirectory(ip, directoryName){
	sh "ssh ${user}@${ip} find ${directoryName}"
}

def createRemoteDirectory(ip, directoryName) {
		sh "ssh ${user}@${ip} mkdir -p ${directoryName}"
}