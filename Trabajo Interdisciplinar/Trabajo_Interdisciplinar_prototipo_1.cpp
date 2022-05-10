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
	ifstream archivo("Lista_alumnos.txt"); 
	while (getline(archivo,line)){
		totalLineas++;
	}/*No lee la línea final.*/
	totalAlumn=totalLineas/3;
	listaAlumnos=new alumno[totalAlumn];
	archivo.close();
	archivo.clear();
	archivo.seekg(0,archivo.beg);
	archivo.open("Lista_alumnos.txt");
	cout<<totalAlumn;
	while (getline(archivo,line2)){
		cout<<line2;
		//xxu
		for (int j=0;j<totalAlumn;j++){
			listaAlumnos[j].nombreApellidos==line2;
			listaAlumnos[j].modalidad==line2;
			listaAlumnos[j].asistencia==line2;
		}
		//xxu
	}

	archivo.close();
	for (int j=0;j<totalAlumn;j++){
		cout<<listaAlumnos[j].nombreApellidos<<endl;
		cout<<listaAlumnos[j].modalidad<<endl;
		cout<<listaAlumnos[j].asistencia<<endl;
	}
	delete [] listaAlumnos;
	return 0;
}

