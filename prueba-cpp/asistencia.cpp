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


struct Datos{
    char modalidad;
    char asistencia;
};


// prototipo de funciones
void menu();
int leerCantAlumnos(string);
void leerListaAlumnos(string,Alumno *&);
void actualizarDatos(string,Alumno *,int);
void parametrizarDatos(Datos &);

int main(){

    const string lista = "lista.txt",
        datos = "datos.txt";

    int totalAlumn = leerCantAlumnos(lista);
    Alumno *listaAlumnos = new Alumno[totalAlumn];
    leerListaAlumnos(lista,listaAlumnos);
    actualizarDatos(datos,listaAlumnos,totalAlumn);

    string opc;
    int aux1;
    char aux;
    string nombre;

    Datos data;
    data.modalidad = '$';
    data.asistencia = '$';

    do{
        menu();
        cout<<"Digite su opción: ";
        getline(cin,opc);
        switch (opc[0]) {
            case '1': 
                for(int i = 0; i < totalAlumn; i++)
                    listaAlumnos[i].getDatos();
            break;
            case '2': 
                for(int i = 0; i < totalAlumn; i++){
                    cout<<"Nro. "<<i+1<<" : "<<listaAlumnos[i].getNombre()<<endl;
                    parametrizarDatos(data);
                    listaAlumnos[i].setModalidad(data.modalidad);
                    listaAlumnos[i].setAsistencia(data.asistencia);
                    data.modalidad = '$';
                    data.asistencia = '$';
                }
            break;
            case '3': {
                cout<<"Digite nombre a buscar: "; 
                getline(cin,nombre);

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
                parametrizarDatos(data);
                listaAlumnos[pos].setModalidad(data.modalidad);
                listaAlumnos[pos].setAsistencia(data.asistencia);
                data.modalidad = '$';
                data.asistencia = '$';
            }
            break;
            case '4': 
                actualizarDatos(datos,listaAlumnos,totalAlumn);
            break;
            default: 
                cout<<"No es una opción válida"<<endl; 
            break;
        }
        cout<<"\033[2J\033[1;1H"; // limpiar pantalla
    }while(opc[0] != '4');

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

void parametrizarDatos(Datos &data){

    string aux; 

    do{
        cout<<"Digite su Modalidad: "; cin>>aux; 
        if(aux.length() == 1){
            aux = toupper(aux[0]);
            if(aux[0] == 'V' || aux[0] == 'P') data.modalidad = aux[0];
            else cout<<"No es una modalidad válida"<<endl;
        }else{
            if(aux == "Virtual" || aux == "virtual") data.modalidad == 'V';
            else if(aux == "Presencial" || aux == "presencial") data.modalidad = 'P';
            else cout<<"No es una modalidad válida"<<endl;
        }
        cout<<"Modalidad: "<<data.modalidad<<endl;
    }while (data.modalidad != '$');
    
    do{
        cout<<"Digite su Asistencia: "; cin>>aux;
        if(aux.length() == 1){
            aux = toupper(aux[0]);
            if(aux[0] == 'A' || aux[0] == 'P' || aux[0] == 'T') data.asistencia = aux[0];
            else cout<<"No es una asistencia válida"<<endl;    
        }else{
            if(aux == "Presente" || aux == "presente") data.asistencia = 'P';
            else if(aux == "Ausente" || aux == "ausente") data.asistencia = 'A';
            else if(aux == "Tardanza" || aux == "tardanza") data.asistencia = 'T';
            else cout<<"No es una modalidad válida"<<endl;
        }
    }while(data.asistencia != '$');

}