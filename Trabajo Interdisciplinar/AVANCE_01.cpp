#include <iostream>
#include <fstream>
using namespace std;
class alumno{
public:
	string nombreApellidos;
	string modalidad;
	string asistencia; 
};
int main(int argc, char *argv[]) {
	int totalAlumn, totalLineas, i;
	alumno* listaAlumnos;
	totalLineas=0;
	string line, line2, line3;
	ifstream archivo("D:\\UNSA\\CIENCIAS DE LA COMPUTACION\\3er semestre\\Trabajo Interdisciplinar\\ASISTENCIA PROYECTO\\datosest.txt"); 
	while (getline(archivo,line)){
		totalLineas++;
	}/*No lee la línea final.*/
	totalAlumn=totalLineas/3;
	listaAlumnos=new alumno[totalAlumn];
	archivo.close();
	archivo.clear();
	archivo.seekg(0,archivo.beg);
	archivo.open("D:\\UNSA\\CIENCIAS DE LA COMPUTACION\\3er semestre\\Trabajo Interdisciplinar\\ASISTENCIA PROYECTO\\datosest.txt");
	cout<<totalAlumn;
	
	int a = 0, d = 1;
	while (getline(archivo,line2)){
		switch (d) {
			case 1:
				listaAlumnos[a].nombreApellidos = line2;
				break;
			case 2:
				listaAlumnos[a].modalidad = line2;
				break;
			case 3:
				listaAlumnos[a].asistencia = line2;
				d = 0;
				a++;
				break;
		}
		d++;
	}
	
	archivo.close();
	
//	int tam = sizeof(listaAlumnos[]) / sizeof(listaAlumnos[0]);
//	cout << tam;
	
	for (int j=0;j<totalAlumn;j++){
		cout<<listaAlumnos[j].nombreApellidos<<endl;
		cout<<listaAlumnos[j].modalidad<<endl;
		cout<<listaAlumnos[j].asistencia<<endl;
	}
	delete [] listaAlumnos;
	return 0;
}
