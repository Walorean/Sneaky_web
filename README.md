# SNEAKYZZ
WTECH_B project created by students from STU FIIT Artem Kinash(ArtemKinash47) and Yevhen Horschar(Walorean), which is an online supermarket for sneakers.

To run our project go to the faze 2 folder and run following commands:
```bash
cd ./faza_2/sneakyzz_laravel
```

Before running generate a seed file:
```bash
php artisan migrate:fresh --seed
```
Link the storage where newly created images for a products will apear
```bash
php artisan storage:link
```
After you can run an application by entering:
```bash
composer run dev
```

after which you should click on the localhost address that is running.