
run these command 

1. composer update
2. php artisan key:generate
3. php artisan migrate //(create the db manually for xamp)
4. php artisan db:seed
5. php artisan l5-swagger:generate //(for api documentation)

Default seeder and factories:
  * UserSeeder::class
  1. RoleSeeder::class,
  2. RouteSeeder::class,
  3. BusSeeder::class,
these are the seeders you dont have to worry about to create them
   'name' => 'zabeer',
    'email' => 'z@gmail.com',
    'password' => Hash::make('password'), // Make sure to hash the password
     'role_id' => 1

after seeding you will get the admin// his role is 1, role 1 for admin and role 2 for gerneral 

******then JetToken*******
set the enviornment variable jwtToken make it null and give these postmanCOde in logincontroller route//

code:

      // Check if the response code is 200 (success)
      if (pm.response.code === 200) {
          // Parse the response JSON
          var jsonData = pm.response.json();
      
          // Extract the token from the response
          var token = jsonData.token;
      
          // Save the token in the environment variable
          pm.environment.set("jwtToken", token);
      
          // Log the token to the console
          console.log("JWT Token:", token);
      }

  if you set this you dont have to set the token everytime.
  <img width="695" alt="image" src="https://github.com/user-attachments/assets/a6f5f026-6c96-4095-aff1-3faaef9807ea" />

  make sure you set three attributes there you need authentication // set them in header
  Content-Type, Accept , Authorization => Bearer {{jwtToken}} 

API Documentation Route=> you will find all the api documentation here/// 
  api/documentation 



      




 
