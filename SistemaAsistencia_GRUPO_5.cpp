#include <cstring>
#include<iostream>
#include<fstream>
#include <string>
using namespace std;


struct Datos{	
//Una estrutura que contiene la modalidad y asistencia de los estudiantes
//Por defecto inicia en "virtual" y "falta"
    char modalidad;
    char asistencia;
    Datos(){
        modalidad = 'V';
        asistencia = 'F';
    }
};

class Alumno{
//Una clase que guarda los datos más importantes de los estudiantes
//Nombre y un puntero a sus datos
    private:
	    string nombreApellidos;
        Datos * registro;
    public:
		
		//Constructor de la clase Alumno
        Alumno(){
            nombreApellidos = "no_nombre";
            registro = new Datos;
        }

		//Destructor de la clase alumno
        ~Alumno(){
            delete registro;
        }
        
		//Método para obtener los datos que tenemos guardados
        void getDatos(){
            cout<<nombreApellidos<<"\n"
            <<"Modalidad: "<<registro->modalidad<<"\t"
            <<"Asistencia: "<<registro->asistencia<<endl<<endl;
        }

		//Funciones que devuelven los Datos
		//Inline hace que cuando se llame la función, automáticamente se
		//se reemplazará por su contenido
        inline string getNombre(){return nombreApellidos;}
        inline char getModalidad(){return registro->modalidad;}
        inline char getAsistencia(){return registro->asistencia;}
        
		//Cambiamos el nombre del alumno
        void setNombre(string nombreApellidos){
            this->nombreApellidos = nombreApellidos;
        }

		//Obtiene la estructura que guarda los datos del estudiante
        Datos * getRegistro(){
            return registro;
        }
};

// prototipos de funciones
void menu();
int leerCantAlumnos(string);
void leerListaAlumnos(string,Alumno *&);
void actualizarDatos(string,Alumno *,int);
void parametrizarDatos(Datos *&);

int main(){
	
    const string lista = "lista.txt", //Archivo donde está la lista
        datos = "datos.txt"; //Archivo donde se guardarán los datos
	
	//Halla el total de alumnos
    int totalAlumn = leerCantAlumnos(lista);
	
	//Reserva la memoria de acuerdo a al total de alumnos
    Alumno *listaAlumnos = new Alumno[totalAlumn];
	
	//Obtiene los datos de los alumnos, una vez que ya se reservó
	//la memoria necesaria para guardarlos
    leerListaAlumnos(lista,listaAlumnos);


    //Guarda los datos que ya obtuvimos de los alumnos
    actualizarDatos(datos,listaAlumnos,totalAlumn);
	
	//Declaracion de las variables que se usarán más adelante
    string opc;
    int aux1;
    string nombre;
    string fecha;


    do{
        menu();
        cout<<"Digite su opcion: ";
		
		//Esta función la linea del operador, pero también extrae los
		//espacios en blanco que genera cin antes
        getline(cin >> ws,opc);
		
		//Se activa ciertas funciones de acuerdo a la opción que ingrsó el usuario
		if(opc.length()>1) opc[0]='5';
        switch (opc[0]) {
			
            case '1': //Imprime los datos de los alumnos
                for(int i = 0; i < totalAlumn; i++)
                    listaAlumnos[i].getDatos();
            break;
			
            case '2': //Tomar la asistencia 1 por 1
				Datos * aux;
                for(int i = 0; i < totalAlumn; i++){
                    cout<<"Nro. "<<i+1<<" : "<<listaAlumnos[i].getNombre()<<endl;
					aux = listaAlumnos[i].getRegistro();
					parametrizarDatos(aux);
                }
            break;
			
			
            case '3': //Modifica los datos de un alumno en específico
			{	
				//Busca el nombre ingresado por el usuario
                cout<<"Digite nombre a buscar: "; 
                getline(cin >> ws,nombre);
				
				//Volvemos a mayúscula todo el string
                for(int i = 0; i != (int)nombre.length(); i++)
                    nombre[i] = toupper(nombre[i]);
                cout<<endl;
				
				//Creamos un array que almacenará las posibles opciones
				int *posiblesOpciones = new int[totalAlumn];
				
				//Imprimimos las posibles Opciones
				int count = 0;
				for(int i = 0; i < totalAlumn; i++) {
					if(listaAlumnos[i].getNombre().find(nombre) != string::npos){
						cout<<count<<" "<<listaAlumnos[i].getNombre()<<endl;
						posiblesOpciones[count] = i;
						count++;
					}
				}
				
				if (count != 0) cout<<count<<" SALIR\n";
				
				//Pide al usuario indicar a cual alumno desea modificar
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
				
				//Imprime los datos y se puede modificar
				if (aux1 < count){
					cout<<"Nro. "<<pos+1<<" : "<<listaAlumnos[pos].getNombre()<<endl;
					Datos * aux = listaAlumnos[pos].getRegistro();
					parametrizarDatos(aux);
					cout << endl;
				}
				
				delete [] posiblesOpciones;
            }
            break;
			
            case '4': //Como guardara el archivo
                cout<<"Ingresse la fecha: ";
                getline(cin,fecha);
                fecha += ".txt";
                actualizarDatos(fecha,listaAlumnos,totalAlumn);
            break;
			
            default: 
                cout<<"No es una opcion valida"<<endl;
            break;
        }
        //cout<<"\033[2J\033[1;1H"; // limpiar pantalla
    }while(opc[0] != '4');
    
    delete [] listaAlumnos;

    return 0;
}

//Imprime las acciones que puede realizar el usuario
void menu(){ 
    cout<<"--------MENU--------"<<endl;
    cout<<"1. Mostrar Lista"<<endl;
    cout<<"2. Tomar Asistencia"<<endl;
    cout<<"3. Modificar Asistencia"<<endl;
    cout<<"4. Guardar y Salir"<<endl;
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

//Función que lee el archivo, pero ahora guarda los nombres de os alumnos
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

//Guarda los datos en un archivo
void actualizarDatos(string datos, Alumno *listaAlumnos, int totalAlumn){
    ofstream archivo;
    archivo.open(datos, ios::out);
    for(int i = 0; i < totalAlumn; i++){
        archivo<<listaAlumnos[i].getModalidad()<<"\t"<<listaAlumnos[i].getAsistencia();
        if(i != totalAlumn-1)
            archivo<<endl;
    }
    archivo.close();
}
	
//Funcion que le pide al usuario cambiar los datos de un alumno
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
