pipeline {
  agent any 

  stages {
    stage('Build') {
      sh 'npm run prod'
    }

    stage('Test') {
      sh 'npm run test'
    }
  }
}