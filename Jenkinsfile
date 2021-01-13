pipeline {
    agent any

    stages {
        stage('Checkout Repository app') {
            steps {
                git branch: 'develop', url: 'https://github.com/LDrender/Test-Laravel.git'
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
