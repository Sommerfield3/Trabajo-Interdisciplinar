#include <cctype>
#include <cstring>
#include<iostream>
#include<fstream>
#include <string>
#include <strings.h>
#include <time.h>
using namespace std;


struct Datos{
    Datos *sig;
    char modalidad;
    char asistencia;
    Datos(){
        sig = NULL;
        modalidad = '$';
        asistencia = '$';
    }
};

class Alumno{
    private:
	    string nombreApellidos;
        Datos *registro;
        Datos *hoy;
    public:
        Alumno(){
            nombreApellidos = "no_nombre";
            registro = new Datos;
            hoy = registro;
        }

        ~Alumno(){
            while (hoy->sig != NULL){
                Datos *aux = hoy;
                hoy = hoy->sig;
                delete aux;
            }
            
        }
        
        void getDatos(){
            cout<<nombreApellidos<<"\n"
            <<"Modalidad: "<<hoy->modalidad<<"\t"
            <<"Asistencia: "<<hoy->asistencia<<endl<<endl;
        }

        inline string getNombre(){return nombreApellidos;}
        inline char getModalidad(){return hoy->modalidad;}
        inline char getAsistencia(){return hoy->asistencia;}
        
        void setNombre(string nombreApellidos){
            this->nombreApellidos = nombreApellidos;
        }

        void setModalidad(char modalidad){
            hoy->modalidad = modalidad;
        }

        void setAsistencia(char asistencia){
            hoy->asistencia = asistencia;
        }


        void setRegistro(char modalidad, char asistencia){
            Datos *nuevo_dia = new Datos;
            nuevo_dia->sig = registro;
            hoy = nuevo_dia; // D -> A B C
        } // {lidts i . w4jtjgjgkf

        Datos * getRegistro(){
            return hoy;
        }
};

// prototipo de funciones
void menu();
int leerCantAlumnos(string);
void leerListaAlumnos(string,Alumno *&);
void actualizarDatos(string,Alumno *,int);
void parametrizarDatos(Datos *&);
void escribirRegistro(string,Alumno *,int);
int main(){

    const string lista = "lista.txt",
        datos = "datos.txt",
		registro = "registro.txt";

    int totalAlumn = leerCantAlumnos(lista);
    Alumno *listaAlumnos = new Alumno[totalAlumn];
    leerListaAlumnos(lista,listaAlumnos);


    
    actualizarDatos(datos,listaAlumnos,totalAlumn);
    string opc;
    int aux1;
    string nombre;


    do{
        menu();
        cout<<"Digite su opcion: ";
        getline(cin >> ws,opc);
		if(opc.length()>1) opc[0]='5';
        switch (opc[0]) {
            case '1': //Mostrar
                for(int i = 0; i < totalAlumn; i++)
                    listaAlumnos[i].getDatos();
            break;
            case '2': //Tomar
                for(int i = 0; i < totalAlumn; i++){
                    cout<<"Nro. "<<i+1<<" : "<<listaAlumnos[i].getNombre()<<endl;
					Datos * aux = listaAlumnos[i].getRegistro();
					parametrizarDatos(aux);
                }
            break;
            case '3': //Modificar 
			{
                cout<<"Digite nombre a buscar: "; 
                getline(cin,nombre);

                for(int i = 0; i != nombre.length(); i++)
                    nombre[i] = toupper(nombre[i]);
                cout<<endl;
				
				int *posiblesOpciones = new int[totalAlumn];
				
				int count = 0;
				for(int i = 0; i < totalAlumn; i++)
					if(listaAlumnos[i].getNombre().find(nombre) != string::npos){
					cout<<count<<" "<<listaAlumnos[i].getNombre()<<endl;
					posiblesOpciones[count] = i;
					count++;
				}
				
				if (count != 0) cout<<count<<" SALIR\n";

                int pos;
                if(count == 0) {
                    cout<<"No se encontro alumnos"<<endl;
                    break;
                }
                else if(count == 1) pos = posiblesOpciones[0];
                else{
                    cout<<"Cual de todos desea actualizar: "; cin>>aux1;
                    pos = posiblesOpciones[aux1];
					
					if (aux1 == count) break;
                }
				
				if (aux1 < count){
					cout<<"Nro. "<<pos+1<<" : "<<listaAlumnos[pos].getNombre()<<endl;
					Datos * aux = listaAlumnos[pos].getRegistro();
					parametrizarDatos(aux);
				}
				
				delete [] posiblesOpciones;

             
            }
			
            break;
            case '4': 
                actualizarDatos(datos,listaAlumnos,totalAlumn);
            break;
            default: 
                cout<<"No es una opcion valida"<<endl;
            break;
        }
        //cout<<"\033[2J\033[1;1H"; // limpiar pantalla
    }while(opc[0] != '4');
    
	escribirRegistro(registro,listaAlumnos,totalAlumn);
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
	
	
void escribirRegistro(string registro, Alumno *listaAlumnos, int totalAlumn){
	ofstream archivo;
	archivo.open(registro);
	for(int i = 0; i < totalAlumn; i++){
		Datos * auxRegis = listaAlumnos[i].getRegistro();
		while(auxRegis != NULL){
			archivo<<auxRegis->modalidad<<"\t"<<auxRegis->asistencia<<"\t";
			cout<<auxRegis->modalidad<<"\t"<<auxRegis->asistencia<<"\t";
			auxRegis = auxRegis->sig;
		}
		archivo<<endl;
	}
	archivo.close();
}

void leerregistro(string registro, Alumno *listaAlumnos, int totalAlumn) {
	ifstream archivo;
	archivo.open(registro);
	int tabs=0;
	while (getline(archivo,line)){
		for (int i=0;i<line.length();i++){
			if(line[i]=='\t' && (tab%2)==1){
				
			}
			
		}
}
	
void parametrizarDatos(Datos *&data){

    string aux; 

    do{
        cout<<"Digite su Modalidad ( V = Virtual , P = Presencial ) : "; cin>>aux; 
        if(aux.length() == 1){
            aux = toupper(aux[0]);
            if(aux[0] == 'V' || aux[0] == 'P') {
				data->modalidad = aux[0];
			}
            else cout<<"No es una modalidad valida"<<endl;
        }else{
            if(aux == "Virtual" || aux == "virtual") data->modalidad = toupper(aux[0]);
            else if(aux == "Presencial" || aux == "presencial") data->modalidad = toupper(aux[0]);
            else cout<<"No es una modalidad valida"<<endl;
        }
		aux = aux[0];
    }while (aux != "V" && aux != "P");
    
    do{
        cout<<"Digite su Asistencia ( F = Falta , P = Presente , T = Tardanza ) : "; cin>>aux;
        if(aux.length() == 1){
            aux = toupper(aux[0]);
            if(aux[0] == 'F' || aux[0] == 'P' || aux[0] == 'T') data->asistencia = aux[0];
            else cout<<"No es una asistencia valida"<<endl;
        }else{
            if(aux == "Presente" || aux == "presente" || aux == "PRESENTE") data->asistencia = toupper(aux[0]);
            else if(aux == "Falta" || aux == "falta" || aux == "FALTA") data->asistencia = toupper(aux[0]);
            else if(aux == "Tardanza" || aux == "tardanza" || aux == "TARDANZA") data->asistencia = toupper(aux[0]);
            else cout<<"No es una asistencia valida"<<endl;
        }
		aux = aux[0];
    }while (aux != "F" && aux != "P" && aux != "T");

}

