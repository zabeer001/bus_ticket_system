
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

  <img width="959" alt="image" src="https://github.com/user-attachments/assets/8b721cb5-1549-4c9f-ad9f-cf720a36c027" />
  <img width="959" alt="image" src="https://github.com/user-attachments/assets/040b9753-95f6-4d8e-901b-bfde39c5c20e" />



though I am giving some photos:
<img width="791" alt="image" src="https://github.com/user-attachments/assets/64ae739b-ccf3-4e5c-86fd-5dbf0e2f0071" />


this is the relationship you will get after seeding// the Database is constructed carefully as the Developer can use ORM , Query builder both, raw sql /// whenever he needs



<img width="947" alt="image" src="https://github.com/user-attachments/assets/2cc5004e-5e98-49b5-9f44-ec8d3d3445e8" />


some demo bus will be created::// 
<img width="894" alt="image" src="https://github.com/user-attachments/assets/9615d524-a0e5-445c-9936-67eb6fbb9ad3" />

user can filter with date and route// those // 
make sure you created bus_schedule first// 
user or admin can only create tickets and only admin can delete tickets// 
after booking the ticket remaining_tickets of bus_schedule will be decareased// a little stock system is made// 

      




 
