const d = document,
    table = d.querySelector(".table"),
    template = d.querySelector(".alumno").content,
    fragment = d.createDocumentFragment(),
    regex = /(\d+)/g;

const createStudent = studentInfo => {
    template.querySelector(".nombre").textContent = studentInfo.nombre
    template.querySelector(".apellido").textContent = studentInfo.apellido
    let clone = d.importNode(template,true);
    return clone
}

const loadFile = file => {
    fetch(file)
    .then(res => res.json())
    .then(json => {
        console.log(json) ;
        json.lista_alumnos.forEach(el => fragment.appendChild(createStudent(el)));
        table.querySelector("tbody").appendChild(fragment)
    })
}

d.addEventListener("DOMContentLoaded",e=>{
    loadFile("lista.json")
})

d.addEventListener("click",e=>{
    if(e.target.matches(".asistencia")){
        let state = e.target.classList[e.target.classList.length - 1];
        let numState = parseInt(state.match(regex))
        numState++
        if(numState ===4)
            numState = 1
        e.target.classList.remove(state)
        e.target.classList.add(`a${numState}`)
    }

    if(e.target.matches(".modalidad")){
        let state = e.target.classList[e.target.classList.length - 1];
        let numState = parseInt(state.match(regex))
    
        numState++
        
        if(numState === 3)
            numState = 1
    
        if(numState === 1)
            e.target.textContent = "P"
        else if(numState === 2)
            e.target.textContent = "V"
    
        
        e.target.classList.remove(state)
        e.target.classList.add(`m${numState}`)
    }

})
