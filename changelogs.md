- username: root
- email: root@domain.com
- password: root

## fixes:

validator:
- fix category validator

any form pages with validator:
- fix validator displaying empty array as blank space

logic/login:
- wrong password redirect to index instead of view/login

view edit:
- change submit button text

index.css:
- set cursor to pointer for todo description
- restyle logo

logic/register:
- add the forgotten session_start();

## preferences:

index.css:
- restyle active favorite button, logo, and todos

logic/validator.php:
- modify register password validator pattern


## optimizations:

nav:
- change logo behavior

favorite:
- query parameter handling

any form pages with validator:
- separate validation message printer into view/valid_msgs

any form's logics:
- use dynamic query instead and optimize query handlings

koneksi, profile:
- only store id_user and username on session and fetch the rest just in profile

profile:
- rename page title

logic/validator:
- check if category exists
- check if username and email already exists when register

index.php:
- improve filter security

# Todolist
A php app to keep track your to-do list

This app is based on my USK (Competency Certification Test) project with more time spent. 