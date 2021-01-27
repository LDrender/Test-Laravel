
// ----------------------------------------------
// Must be configured by app
// ----------------------------------------------
appName = "mekalink"
appUseSSL = true


devHostName = "srvmekalinkdev.amplitude-ortho.com"
prodHostName = "srvmekalinkprod.amplitude-ortho.com"

dbHost = "db"
dbUser = "root"
dbPassword = "SLXMK6BCCYWWTA3J"
secretFolder = "/var/secret/mekalink"
mysqlPassword = "M3kaL1f0"

appDevLocal = true
appDevIpDev = "10.0.0.6"
appDevIpProd = "10.0.0.7"

dockerFilesDirectory="./build/"
user="lduchier"

// ----------------------------------------------
// Can be configured by app
// ----------------------------------------------

def configuration() {
	return [
		prod: [

			mysql: 3306,
			mysqlDataBase: "mekalink",
			mysqlPassword: dbPassword,
			host: prodHostName,
			smtp: 8025,
			dockerTag: "prod"
		],
		dev: [
			app: 23180,
			appDebug: 23181,
			mysql: 23108,
			mysqlDataBase: "mekalink",
			mysqlPassword: mysqlPassword,
			smtp: 23109,
			host: devHostName,
			dockerTag: "dev"
		]
	]
}

def pushToEnvironmentSpecific(configuration) {
	
	def sqlFile = dumpDatabase(configuration, "${configuration.mysqlDataBase}", "${dbUser}", "${dockerFilesDirectory}/mysql-${configuration.dockerTag}")
	copyFileToRemote(sqlFile, "~/mysql-${configuration.dockerTag}/", configuration.ip)

}


// ----------------------------------------------
// Can not be configured by app : Process
// ----------------------------------------------

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
	
	fillFiles(configuration)
	
	pushToEnvironmentSpecific(configuration)
				
	copyDockerFile(configuration.dockerTag, configuration.ip)
	
	restartDocker(configuration.ip, configuration.dockerTag)
	
	writeJenkinsBuildInfos(configuration)
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
	if (configuration.smtp == null) {
		configuration.smtp = 0
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



// --- Groovy helpers ---

def getIp(hostName) {
	//VMWare Test
	if(appDevLocal == true){
		if(hostName == devHostName){
			return appDevIpDev
		}
		else if(hostName == prodHostName){
			return appDevIpProd
		}
	}

	def address = InetAddress.getByName(hostName); 
	return address.getHostAddress();
}


// --- Docker helpers ---

def restartDocker(ip, destEnvName) {

	sh "ssh ${user}@${ip} docker-compose -f docker-compose.yml stop"
	sh "ssh ${user}@${ip} docker-compose -f docker-compose.yml rm --force"
	sh "ssh ${user}@${ip} docker-compose -f docker-compose.yml up -d"
	
}


def copyDockerFile(dockerTag, ip) {
	sh "docker save -o ${appName}-${dockerTag}.img ${appName}:${dockerTag}"
	sh "scp ${appName}-${dockerTag}.img ${user}@${ip}:~/${appName}-${dockerTag}.img"
	sh "ssh ${user}@${ip} docker load -i ${appName}-${dockerTag}.img"
}


def fillFiles(configuration) {

	def variables = [
		appName: appName+"-"+configuration.dockerTag,
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

// --- Jenkins helpers ---

def writeJenkinsBuildInfos(configuration) {
	def description = "";
	if (appUseSSL) {
		description += """<a href="https://${configuration.host}:${configuration.app}">Accéder à l'application</a><br/>"""
	} else {
		description += """<a href="http://${configuration.ip}:${configuration.app}">Accéder à l'application</a><br/>"""
	}
	if (toInt("" + configuration.smtp) != 0) {
		description += """<a href="http://${configuration.ip}:${configuration.smtp}">Accéder au serveur Smtp</a><br/>"""
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
	sh "mysqldump -h${dbHost} --port=${environment.mysql} -u ${dbUserName} -p${environment.mysqlPassword} ${dbName} > ${targetFolder}/${dbName}.sql"
	return "${targetFolder}/${dbName}.sql"
}


// --- File helpers ---

def copyFileToRemote(localFileName, remoteFileName, ip) {
	sh "rsync -r ${localFileName} ${user}@${ip}:${remoteFileName}"
}