pipeline {
    agent any
    stages {
		stage('Checkout') {
			steps {
				script {
				// The below will clone your repo and will be checked out to master branch by default.
				git credentialsId: 'jenkins-user-github', url: 'https://github.com/LDrender/Test-Laravel.git'
				// Do a ls -lart to view all the files are cloned. It will be clonned. This is just for you to be sure about it.
				sh "ls -lart ./*" 
				// List all branches in your repo. 
				sh "git branch -a"
				// Checkout to a specific branch in your repo.
				sh "git checkout develop"
				}
			}
		}
        stage("Build") {
            environment {
                DB_HOST = credentials("Mekalink-DB-Host")
                DB_DATABASE = credentials("	Mekalink-DB-Name")
                DB_USER = credentials("Mekalink-DB")
            }
            steps {
                sh 'cp .env.example .env'
                sh 'echo DB_HOST=${DB_HOST} >> .env'
                sh 'echo DB_USERNAME=${DB_USER_USR} >> .env'
                sh 'echo DB_DATABASE=${DB_DATABASE} >> .env'
                sh 'echo DB_PASSWORD=${DB_USER_PSW} >> .env'
            }
        }
        stage("Docker build") {
            steps {
                sh "sudo docker-compose build"
            }
        }
		stage("Docker up") {
            steps {
                sh "sudo docker-compose up"
            }
        }
		stage("Unit test") {
            steps {
                sh 'php artisan test'
            }
        }
    }
}