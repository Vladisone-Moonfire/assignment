# Assignment

## Descriere Scurta

Assignment-ul a fost realizat folosind stack-ul Php-> Laravel pentru backend si typescript -> Nextjs pentru front.

Proiectul este impartit in 2 foldere care reprezinta stack-ul de mai sus, un folder pentru backend, numit backend, si unul pentru front, numit breeze-next.
In folderul root al proiectului se afla si un docker-compose menit sa ruleze serviciul pentru baza de date locala.

## Comenzi pentru initializarea proiectului:

    -docker compose up -d (in folderul root pentru initializarea containerului de db)

    -npm i (in folderul pentru frontend pentru initializarea pachetelor)
    -npm run dev (in folderul pentru frontend pentru rularea serviciului)
    -crearea env-ului din env.example

    -composer install (in folderul pentru backend pentru initializarea pachetelor)
    -php artisan migrate (in folderul pentru backend pentru rularea migrarilor)
    -php artisan serve (in folderul pentru backend pentru rularea serviciului)
    -php artisan db:seed (in folderul pentru backend pentru initilizarea db-ului de produse cu 100K produse, atentie va dura ceva)
    -crearea env-ului din env.example

## User management

Pentru prima parte a task-ului, cea de useri si auth am folosit pachetul Breeze din documentatia Laravel, generare clasica de API pentru partea de autentificare, legat la un template de nextJs cu functionalitati de baza: login, logout. register.
Am schimbat in aceste metode strucura de date ca sa respecte cerintele de proprietati cerute pentru tabela de useri. In plus am adaugat metoda de change email pentru userul autentificat.
Toate aceste functionalitati sunt disponibile de testat pe localhost:3000 dupa pornirea serviciilor.

## Products API

Pentru a doua partea a task-ului, cea legata de produse, am creat de la 0 un API pe structura Domain Driven Design, care se afla in folderul app/Src in prouiectul de backend.
Momentan, proiectul de backend are atat arhitectura clasica, unde au fost generate clasele de Breeze, dar si aceasta DDD, care este modul meu uzual de a lucra. Nu am mai convertiti si Breez-ul la DDD deoarece nu adauga plus valoare assignmentului.

Deoarece avem aceasta arhitectura duala, nu am mai modificat sursele proiectului sa reflecte in intregime domeniile create (adica cel de produse).

Pentru API-ul de produse am adaugat acel seed ce populeaza baza de date cu 100K entry-uri fake-uite pentru testarea rapiditatii requestu-urilor si cu un numar relativ maricel de date. Raspunsurile sunt de oridinul milisecundelor.
API-ul de produse are toate metodele cerute si anume: Index, View, Create, Update, Delete. 
Totodata, pentru ruta de index am adaugat paginare, deoarece lucram cu multe date, sortare si filtrare. In postman puteti folosii parametrii de sortare: sort = {numele coloanei} sau sort - {-numele coloanei} pentru a sorta crescator sau descrescator, filter[{numele coloanei}] = "test" pentru a filtra orice coloana dupa un anumit substring.
Coloanele care permit filtrare au fost indexate in baza de date pentru a facilita raspunsurile rapide.

Rute pentru API-ul de products:
    GET -> /api/produsts -> index
    GET -> /api/produsts/{id} -> view
    PUT -> /api/produsts/{id} -> update
    DELETE -> /api/produsts/{id} -> delete
    CREATE -> /api/produsts/ -> create

## Closing remarks

Va stau la dispozitie daca am ratat vreun subiect, deoarece este o descriere pe scurt a assignment-ului. Tin sa mentionez ca puteam sa mai adaug elemente proiectului, cum ar fi dockerizarea tuturor serviciilor, generare de client pentru API sau customizarea totala a frontend-ului, dar am considerat ca nu aduc o valoare semnificativa in raport cu timpul necesar.

## Numai bine!
## Vlad Tureanu.
