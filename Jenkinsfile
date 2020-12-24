pipeline {
    agent any
    stages {
        stage("Build") {
            environment {
                DB_HOST = credentials("Mekalink-DB-Host")
                DB_DATABASE = credentials("	Mekalink-DB-Name")
                DB_USERNAME = credentials("Mekalink-DB-USR")
                DB_PASSWORD = credentials("Mekalink-DB-PSW")
            }
            steps {
                sh 'php --version'
                sh 'composer install'
                sh 'composer --version'
                sh 'cp .env.example .env'
                sh 'echo DB_HOST=${DB_HOST} >> .env'
                sh 'echo DB_USERNAME=${DB_USERNAME} >> .env'
                sh 'echo DB_DATABASE=${DB_DATABASE} >> .env'
                sh 'echo DB_PASSWORD=${DB_PASSWORD} >> .env'
                sh 'php artisan key:generate'
                sh 'cp .env .env.testing'
                sh 'php artisan migrate'
            }
        }
        stage("Unit test") {
            steps {
                sh 'php artisan test'
            }
        }
        stage("Docker build") {
            steps {
                sh "docker-compose build"
            }
        }
        stage("Deploy to staging") {
            steps {
                sh "docker-compose up -d"
            }
        }
    }
}