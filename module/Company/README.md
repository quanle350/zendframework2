# Sample Company Modulefor Zend Framework 2

## Introduction

Album is a sample Module based on the <a href="https://github.com/tiger0350/zendframework2.git">(Getting Started)</a> guide framework.zend.com .

## Installation

### Main Setup

1. Clone this project into your './module/' directory and enable it in your
   'application.config.php' file.

'''php
return array(
    'modules' => array(
        'Application',
        'company',//add this to your configuration
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),

    ),
);
'''

Copy the These files

 * 'module/Company/config/database.local.php.dist' to 'config/autload/database.local.php'
 * 'module/Company/config/global.php.dist' to 'config/autload/global.php'

###Database Setup
Import module/Company/data/Company.sql into your database

###Usage
Browser to the company page

'your-domain-name/company'