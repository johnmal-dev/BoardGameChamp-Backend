# BoardGameChamp

## Setting Up Sail

Need to get sail composer package installed without local version of php involved

need to copy env file (make sure you have a db defined)

need to run sail build

need to run sail up -d (to run in background)

need to run migrations and seeders

if migrations fail due to mysql, other volumes may be taking up ports. run `docker-compose down --volumes` to kill them and then run `sail up -d` as usual
