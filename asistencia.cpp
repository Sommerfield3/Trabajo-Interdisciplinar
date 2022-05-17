#include <cctype>
#include <cstring>
#include<iostream>
#include<fstream>
#include <string>
#include <strings.h>
using namespace std;

class Alumno{
    private:
	    string nombreApellidos;
	    char modalidad;
	    char asistencia;
    public:
        Alumno(){
            nombreApellidos = "no_nombre";
            modalidad = 'V';
            asistencia = 'A';
        }
        
        
        void getDatos(){
            cout<<nombreApellidos<<"\n"
            <<"Modalidad: "<<modalidad<<"\t"
            <<"Asistencia: "<<asistencia<<endl<<endl;
        }

        inline string getNombre(){return nombreApellidos;}
        inline char getModalidad(){return modalidad;}
        inline char getAsistencia(){return asistencia;}
        
        void setNombre(string nombreApellidos){
            this->nombreApellidos = nombreApellidos;
        }

        void setModalidad(char modalidad){
            this->modalidad = modalidad;
        }

        void setAsistencia(char asistencia){
            this->asistencia = asistencia;
        }
};

// prototipo de funciones
void menu();
int leerCantAlumnos(string);
void leerListaAlumnos(string,Alumno *&);
void actualizarDatos(string,Alumno *,int);

int main(){

    const string lista = "lista.txt",
        datos = "datos.txt";

    int totalAlumn = leerCantAlumnos(lista);
    Alumno *listaAlumnos = new Alumno[totalAlumn];
    leerListaAlumnos(lista,listaAlumnos);
    actualizarDatos(datos,listaAlumnos,totalAlumn);

    int opc, aux1;
    char aux;
    string nombre;
    do{
        menu();
        cout<<"Digite su opción: ";
        cin>>opc;
        switch (opc) {
            case 1: 
                for(int i = 0; i < totalAlumn; i++)
                    listaAlumnos[i].getDatos();
            break;
            case 2: 
                for(int i = 0; i < totalAlumn; i++){
                    cout<<"Nro. "<<i+1<<" : "<<listaAlumnos[i].getNombre()<<endl;
                    
                    cout<<"Digite su Modalidad: "; cin>>aux; aux = toupper(aux);
                    if(aux == 'V' || aux == 'P') listaAlumnos[i].setModalidad(aux);
                    else cout<<"No es una modalidad válida"<<endl;

                    cout<<"Digite su Asistencia: "; cin>>aux; aux = toupper(aux);
                    if(aux == 'A' || aux == 'P' || aux == 'T') listaAlumnos[i].setAsistencia(aux);
                    else cout<<"No es una asistencia válida"<<endl;
                }
                actualizarDatos(datos,listaAlumnos,totalAlumn);
            break;
            case 3: {
                cout<<"Digite nombre a buscar: "; cin>>nombre;
                for(int i = 0; i != nombre.length(); i++)
                    nombre[i] = toupper(nombre[i]);

                cout<<endl;
                int posiblesOpciones[totalAlumn];

                int count = 0;
                for(int i = 0; i < totalAlumn; i++)
                    if(listaAlumnos[i].getNombre().find(nombre) != string::npos){
                        cout<<count<<" "<<listaAlumnos[i].getNombre()<<endl;
                        posiblesOpciones[count] = i;
                        count++;
                    }
                cout<<endl;

                int pos;
                if(count == 0) {
                    cout<<"No se encontro alumnos"<<endl;
                    break;
                }
                else if(count == 1) pos = posiblesOpciones[0];
                else{
                    cout<<"Cual de todos desea actualizar: "; cin>>aux1;
                    pos = posiblesOpciones[aux1];
                }

                cout<<"Nro. "<<pos+1<<" : "<<listaAlumnos[pos].getNombre()<<endl;
                    
                cout<<"Digite su Modalidad: "; cin>>aux; aux = toupper(aux);
                if(aux == 'V' || aux == 'P') listaAlumnos[pos].setModalidad(aux);
                else cout<<"No es una modalidad válida"<<endl;

                cout<<"Digite su Asistencia: "; cin>>aux; aux = toupper(aux);
                if(aux == 'A' || aux == 'P' || aux == 'T') listaAlumnos[pos].setAsistencia(aux);
                else cout<<"No es una asistencia válida"<<endl;
                actualizarDatos(datos,listaAlumnos,totalAlumn);
            }
            break;
            case 4: break;
            default: 
                cout<<"No es una opción válida"<<endl; 
            break;
        }
    }while(opc != 4);

    delete [] listaAlumnos;

    return 0;
}

void menu(){
    cout<<"--------MENU--------"<<endl;
    cout<<"1. Mostrar Lista"<<endl;
    cout<<"2. Tomar Asistencia"<<endl;
    cout<<"3. Modificar Asistencia"<<endl;
    cout<<"4. Salir"<<endl;
}   

int leerCantAlumnos(string lista){
    int totalAlumn = 0;
    string line;
    ifstream archivo;
    archivo.open(lista);
    while (getline(archivo,line)) 
        totalAlumn++;
    archivo.close();

    return totalAlumn;
}

void leerListaAlumnos(string lista, Alumno *&listaAlumnos){
    ifstream archivo;
    string line;
    archivo.open(lista);
    int i = 0;
    while (getline(archivo,line)) {
        listaAlumnos[i].setNombre(line);
        i++;
    }
    archivo.close();
}

void actualizarDatos(string datos, Alumno *listaAlumnos, int totalAlumn){
    ofstream archivo2;
    archivo2.open(datos, ios::out);
    for(int i = 0; i < totalAlumn; i++){
        archivo2<<listaAlumnos[i].getModalidad()<<"\t"<<listaAlumnos[i].getAsistencia();
        if(i != totalAlumn-1)
            archivo2<<endl;
    }
    archivo2.close();
}
