#include <iostream>
#include <windows.h>
#include <fstream>
#include <conio.h>
#include <ctime>

using namespace std;
int cena=0;
void nazwa_restauracji() {
    static const string linia = "---------------------------------------------";
    cout << linia << endl;
    char nazwa[50];
    ifstream odczyt;
    odczyt.open("../setup.txt", ios::in);
    for (int i = 0; i < 18; i++)
        odczyt >> nazwa[i];
    for (int i = 5; i < 18; i++) {
        if (i == 15)
            cout << " ";
        cout << nazwa[i];
    }
    cout << endl << linia << endl;
}

void menu() {
    cout    <<"____________________________________"    <<endl;
    cout    << "Burgery" << endl;
    fstream plik2;
    plik2.open("../Burger.txt", ios::in);
    if (plik2.good() == false) {
        cout << "Nie ma takiego pliku";
        exit(0);
    }
    string linia[10];
    int i = 1;
    while (getline(plik2, linia[i])) {

        cout << "[" << i << "]" << linia[i] << endl;

        i++;
    }
    plik2.close();


    cout << endl;
    cout    <<"____________________________________"    <<endl;
    cout << "Pizza" << endl << endl;
    fstream plik;
    plik.open("../Pizza.txt.txt", ios::in);
    if (plik.good() == false) {
        cout << "Nie ma takiego pliku";
        exit(0);
    }


    while (getline(plik, linia[i])) {


        cout << "[" << i << "]" << linia[i] << endl;

        i++;
    }
    plik.close();
    cout<<  endl    <<  endl;
    cout    <<"____________________________________"    <<endl;
    cout << "Woda" << endl << endl;
    fstream plik3;
    plik3.open("../Woda.txt", ios::in);
    if (plik3.good() == false) {
        cout << "Nie ma takiego pliku";
        exit(0);
    }


    while (getline(plik3, linia[i])) {

        cout << "[" << i << "]" << linia[i] << endl;

        i++;
    }
    plik3.close();


    cout    <<"____________________________________"    <<endl;

    cena=cena-cena;

    cout << endl;


    time_t now=time(0);
    char* date_time= ctime(&now);

    fstream historia;
    historia.open("../historia.txt", ios::app);

    fstream zamowienie;
    zamowienie.open("../orders.txt", ios::out);

    int wybor;
    cout
            << "Prosze zlozyc zamowienie poprzez wpsianie odpowiedniej cyfry, a po zakonczeniu prosze o wprowadzenie cyfry zero: "
            << endl;

    zamowienie<<"____________________________________"<<endl;
    zamowienie<<date_time<<endl;

    historia<<"____________________________________"<<endl;
    historia<<date_time<<endl;

    historia<<"ID zamowienia: ";
    zamowienie<<"ID zamowienia: ";

    char result[15];
    srand(time(NULL));
    for (int i = 0; i < 15; i++) {
        result[i] = rand() % 46 + 78;
        historia << result[i];
        zamowienie<< result[i];
    }

    historia<<endl;
    zamowienie<<endl;
    zamowienie<<"____________________________________"<<endl;
    historia<<"____________________________________"<<endl;

    int dania = 0;

    do {
        cout<<"Prosze podac id zamowienia: ";

        cin >> wybor;
        cout<<endl;
       switch(wybor)
       {
           case 1:
           {
               cena= cena+10;
               break;
           }
           case 2:
           {
                cena=cena+15;
               break;
           }case 3:
           {
                cena=cena+20;
               break;
           }case 4:
           {
               cena= cena+10;
               break;
           }case 5:
           {
               cena=cena+15;
               break;
           }case 6:
           {
               cena=cena+20;
               break;
           }case 7:
           {
               cena= cena+10;
               break;
           }case 8:
           {
               cena=cena+15;
               break;
           }case 9:
           {
               cena=cena+20;
               break;
           }
           default:
           {

               break;
           }
       }
        dania++;
        if (wybor == 0) {
            break;
        }
        if(wybor>9)
        {
            cout<<"Podana zostala zla wartosc, prosze wybrac jeszcze raz."<<endl;
            dania--;
        }
            zamowienie << linia[wybor] << endl;
            historia    <<linia[wybor] << endl;

    } while (dania < 10);
    cout << "Koszt zamowienia wynosi: "<<cena<<"zl"<<endl;
    cout << "Pamietaj!!! Mozesz dodac tylko 10 dan." << endl;

    zamowienie.close();
}

void dodawanie() {

    cout << "Twoje zamowinie to: " << endl;
    string linia3;
    int a = 1;
    fstream zamowienie;
    zamowienie.open("../orders.txt", ios::in);
    {
        while (getline(zamowienie, linia3)) {
            cout <<  linia3 << endl;
            a++;
        }
    }
    cout << "Koszt zamowienia wynosi: "<<cena<<"zl"<<endl;
    zamowienie.close();





    cout << "Burgery" << endl << endl;
    fstream plik2;
    plik2.open("../Burger.txt", ios::in);

    string linia[10];
    int i=1;
    while (getline(plik2, linia[i])) {

        cout << "[" << i << "]" << linia[i] << endl;

        i++;
    }
    plik2.close();
    for (int i = 0; i < 40; i++)
        cout << "_ ";

    cout << endl << endl;

    cout << "Pizza" << endl << endl;
    fstream plik;
    plik.open("../Pizza.txt.txt", ios::in);



    while (getline(plik, linia[i])) {



        cout << "[" << i << "]" << linia[i] << endl;

        i++;
    }

    plik.close();

    for (int i = 0; i < 40; i++)
        cout << "_ ";

    cout << "Woda" << endl << endl;
    fstream plik3;
    plik3.open("../Woda.txt", ios::in);
    if (plik3.good() == false) {
        cout << "Nie ma takiego pliku";
        exit(0);
    }


    while (getline(plik3, linia[i])) {

        cout << "[" << i << "]" << linia[i] << endl;

        i++;
    }
    plik3.close();
    for (int i = 0; i < 40; i++)
        cout << "_ ";


    cout << endl;

    fstream historia;
    historia.open("../historia.txt", ios::app);
    zamowienie.open("../orders.txt", ios::app);
    int wybor;

    cout
            << "Prosze zlozyc zamowienie poprzez wpsianie odpowiedniej cyfry, a po zakonczeniu prosze o wprowadzenie cyfry zero: "
            << endl;

    int dania = 0;

    do {
        cout<<"Prosze podac id zamowienia: ";
        cin >> wybor;
        cout<<endl;
        dania++;
        switch(wybor)
        {
            case 1:
            {
                cena= cena+10;
                break;
            }
            case 2:
            {
                cena=cena+15;
                break;
            }case 3:
            {
                cena=cena+20;
                break;
            }case 4:
            {
                cena= cena+10;
                break;
            }case 5:
            {
                cena=cena+15;
                break;
            }case 6:
            {
                cena=cena+20;
                break;
            }case 7:
            {
                cena= cena+10;
                break;
            }case 8:
            {
                cena=cena+15;
                break;
            }case 9:
            {
                cena=cena+20;
                break;
            }
            default:
            {

                break;
            }

        }


        zamowienie << linia[wybor] << endl;
        historia   << linia[wybor] << endl;
        if(wybor>9)
        {
            cout<<"Podana zostala zla wartosc, prosze wybrać jeszcze raz.";
            dania--;
        }

    } while (dania < 10);
    zamowienie<<"Koszt zamowienia wynosi: "<<cena<<"zl"<<endl;
    historia<<"Koszt zamowienia wynosi: "<<cena<<"zl"<<endl;
    zamowienie<<"____________________________________"<<endl;
    historia<<"____________________________________"<<endl;

    cout << "Pamietaj!!! Mozesz dodac tylko 10 dan." << endl;


    zamowienie.close();

}

void Zloz_zamowienie() {
    {
        menu();
        Sleep(500);
        char wybor;
        string wiecej;
        cout << "Czy chcesz dobrac cos do aktualnego zamowienia? " << endl << "[1] Tak" << endl << "[2] Nie" << endl
             << "[3] Jezeli chcesz zlozyc zamowienie na nowo" << endl << "[9] Wyjscie z aplikacji" << endl;
        char dobranie_zamowienia;
        dobranie_zamowienia = _getch();
        switch (dobranie_zamowienia) {
            case '1':
                cout << "Co chcesz domowic?" << endl;
                dodawanie();
                break;
            case '2':{
                fstream zamowienie,historia;
                int a=1;
                zamowienie.open("../orders.txt", ios::in | ios::app);
                historia.open("../historia.txt", ios::app);
                zamowienie<<"Koszt zamowienia wynosi: "<<cena<<"zl"<<endl;
                string linia[10000];
                while(getline(zamowienie,linia[a]));
                {
                    cout<<linia[a]<<endl;
                }
                zamowienie<<"____________________________________"<<endl;
                historia<<"____________________________________"<<endl;
                historia<<"Koszt zamowienia wynosi: "<<cena<<"zl"<<endl;

                wybor = false;
                zamowienie.close();
                break;}
            case '3':
                menu();
                break;
            case '9':
                cout << endl << "Do zobaczenia";

                Sleep(1000);
                exit(0);
            default:
                cout << "Wpisales zla wartosc, zloz zamowienie jeszcze raz." << endl;
                menu();

        }
        cout << "Twoje zamowinie to: " << endl;
        string linia3;
        int a = 1;
        fstream zamowienie;
        zamowienie.open("../orders.txt", ios::in);
        {
            while (getline(zamowienie, linia3)) {
                cout << linia3 << endl;
                a++;
            }
        }
        zamowienie.close();

    }
}

void Historia_zamowien() {

    fstream historia;
    historia.open("../historia.txt", ios::in);
    string linia[1000];
    int a=1;
    while(getline(historia,linia[a]))
    {
        cout<<linia[a]<<endl;
        a++;
    }









}

string Historia_zamowien_data() {
    return "Historia zamowien dla danej daty\n";
}

void zadanie(int opcja) {
    switch (opcja) {
        case 1:
            Zloz_zamowienie();
            break;
        case 2:
            Historia_zamowien();
            break;
        case 3:
            Historia_zamowien_data();
            break;
        default:
            cout<<"Niepoprawnie wybrana opcja";
    }
}

void interfejs() {
    string interfejs =
            {
                    "\nOpcje:\n"
                    "[0]Zamknij program\n"
                    "[1]Zloz zamowienie\n"
                    "[2]Historia zamowien\n"
                    "[3]Historia zamowien dla danego dnia\n"
                    "\nProsze podac opcje: "
            };
    cout << interfejs;
}

int main() {

    int opcja;
    nazwa_restauracji();
    cout<<"Witam w Programie Restauracja 4.5"<<endl;
    while (true) {
        interfejs();
        cin >> opcja;
        if (opcja == 0) {
            cout << "Program konczy dzialanie";
            return 0;
        } else
            zadanie(opcja);
    };
}
