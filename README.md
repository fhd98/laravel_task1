## Setup

git clone https://github.com/fhd98/laravel_task1
cd laravel_task1

## Executing

composer install
npm install && npm run build

After this you can run the migrations after creating DB. ENV is still in the repo for ease if setup. 
Database in Postgres and db name is authTask.

Breeze and Inertia are used basically. Role based authentication is also implemented. 

On normal users dashboard there is option to edit profile, add image etc and view it. Changing passwords and deleting their own account is applicable.

For super admin role, role can be added in db in the role column by setting it as "superadmin". Then Super admin is able to see another tab in navigation bar as Users. They can see all users and also delete any user. 

Rate limiting is applied to 15 per minute. Middleware used for auth and super admin ensuring. 