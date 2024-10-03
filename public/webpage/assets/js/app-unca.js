var btnOpenAccordionList = document.querySelectorAll(".btn-arcjas");
btnOpenAccordionList.forEach(function (toggleButton) {
  var targetButton = document.querySelector(
    toggleButton.getAttribute("data-target")
  );
  targetButton.classList.remove("show-acordion");
  toggleButton.addEventListener("click", function () {
    hideContentAcordionAll();
    var target = document.querySelector(
      toggleButton.getAttribute("data-target")
    );
    if (toggleButton.id == "btn-ordinario") {
      document.getElementById("btn-ordinario").style.background = "#416CDC";
      document.getElementById("btn-extraordinario").style.background = "";      
    } else if (toggleButton.id == "btn-extraordinario") {
      document.getElementById("btn-ordinario").style.background = "";
      document.getElementById("btn-extraordinario").style.background = "#416CDC";      
    

    } else if (toggleButton.id == "btn-estrategicos") {
      document.getElementById("btn-estrategicos").style.background = "#416CDC";
      document.getElementById("btn-misionales").style.background = "";
      document.getElementById("btn-apoyo").style.background = "";
    } else if (toggleButton.id == "btn-misionales") {      
      document.getElementById("btn-misionales").style.background = "#416CDC";
      document.getElementById("btn-estrategicos").style.background = "";      
      document.getElementById("btn-apoyo").style.background = "";
    } else if (toggleButton.id == "btn-apoyo") {      
      document.getElementById("btn-apoyo").style.background = "#416CDC";
      document.getElementById("btn-estrategicos").style.background = "";      
      document.getElementById("btn-misionales").style.background = "";


    } else if (toggleButton.id == "btn-informacion") {
      document.getElementById("btn-informacion").style.background = "#416CDC";
      document.getElementById("btn-documentos").style.background = "";
      document.getElementById("btn-actas").style.background = "";
      document.getElementById("btn-resoluciones").style.background = "";
    } else if (toggleButton.id == "btn-documentos") {      
      document.getElementById("btn-documentos").style.background = "#416CDC";
      document.getElementById("btn-informacion").style.background = "";      
      document.getElementById("btn-actas").style.background = "";
      document.getElementById("btn-resoluciones").style.background = "";
    } else if (toggleButton.id == "btn-actas") {      
      document.getElementById("btn-actas").style.background = "#416CDC";
      document.getElementById("btn-informacion").style.background = "";      
      document.getElementById("btn-documentos").style.background = "";
      document.getElementById("btn-resoluciones").style.background = "";
    } else if (toggleButton.id == "btn-resoluciones") {      
      document.getElementById("btn-resoluciones").style.background = "#416CDC";
      document.getElementById("btn-informacion").style.background = "";      
      document.getElementById("btn-actas").style.background = "";
      document.getElementById("btn-documentos").style.background = "";

    } else if (toggleButton.id == "btn-proyectos") {      
      document.getElementById("btn-proyectos").style.background = "#416CDC";
      document.getElementById("btn-repositorio").style.background = "";    
    } else if (toggleButton.id == "btn-repositorio") {      
      document.getElementById("btn-repositorio").style.background = "#416CDC";
      document.getElementById("btn-proyectos").style.background = "";      
      
      
    } else if (toggleButton.id == "btn-financiera") {      
      document.getElementById("btn-financiera").style.background = "#416CDC";
      document.getElementById("btn-remuneraciones").style.background = "";    
    } else if (toggleButton.id == "btn-remuneraciones") {      
      document.getElementById("btn-remuneraciones").style.background = "#416CDC";
      document.getElementById("btn-financiera").style.background = "";      


    } else if (toggleButton.id == "btn-admision") {      
      document.getElementById("btn-admision").style.background = "#416CDC";
      document.getElementById("btn-docacademicos").style.background = "";    
      document.getElementById("btn-postulantes").style.background = "";    
      document.getElementById("btn-docentes").style.background = "";    
      document.getElementById("btn-becas").style.background = "";    
      document.getElementById("btn-ambientes").style.background = "";    
      document.getElementById("btn-silabus").style.background = "";   
      
    } else if (toggleButton.id == "btn-docacademicos") {      
      document.getElementById("btn-docacademicos").style.background = "#416CDC";
      document.getElementById("btn-admision").style.background = "";    
      document.getElementById("btn-postulantes").style.background = "";    
      document.getElementById("btn-docentes").style.background = "";    
      document.getElementById("btn-becas").style.background = "";    
      document.getElementById("btn-ambientes").style.background = "";    
      document.getElementById("btn-silabus").style.background = "";   

    } else if (toggleButton.id == "btn-postulantes") {      
      document.getElementById("btn-postulantes").style.background = "#416CDC";
      document.getElementById("btn-admision").style.background = "";    
      document.getElementById("btn-docacademicos").style.background = "";    
      document.getElementById("btn-docentes").style.background = "";    
      document.getElementById("btn-becas").style.background = "";    
      document.getElementById("btn-ambientes").style.background = "";    
      document.getElementById("btn-silabus").style.background = "";  
      
    } else if (toggleButton.id == "btn-docentes") {      
      document.getElementById("btn-docentes").style.background = "#416CDC";
      document.getElementById("btn-admision").style.background = "";    
      document.getElementById("btn-docacademicos").style.background = "";    
      document.getElementById("btn-postulantes").style.background = "";    
      document.getElementById("btn-becas").style.background = "";    
      document.getElementById("btn-ambientes").style.background = "";    
      document.getElementById("btn-silabus").style.background = "";  

    } else if (toggleButton.id == "btn-becas") {      
      document.getElementById("btn-becas").style.background = "#416CDC";
      document.getElementById("btn-admision").style.background = "";    
      document.getElementById("btn-docacademicos").style.background = "";    
      document.getElementById("btn-postulantes").style.background = "";    
      document.getElementById("btn-docentes").style.background = "";    
      document.getElementById("btn-ambientes").style.background = "";    
      document.getElementById("btn-silabus").style.background = "";  

    } else if (toggleButton.id == "btn-ambientes") {      
      document.getElementById("btn-ambientes").style.background = "#416CDC";
      document.getElementById("btn-admision").style.background = "";    
      document.getElementById("btn-docacademicos").style.background = "";    
      document.getElementById("btn-postulantes").style.background = "";    
      document.getElementById("btn-docentes").style.background = "";    
      document.getElementById("btn-becas").style.background = "";    
      document.getElementById("btn-silabus").style.background = "";  

    } else if (toggleButton.id == "btn-silabus") {      
      document.getElementById("btn-silabus").style.background = "#416CDC";
      document.getElementById("btn-admision").style.background = "";    
      document.getElementById("btn-docacademicos").style.background = "";    
      document.getElementById("btn-postulantes").style.background = "";    
      document.getElementById("btn-docentes").style.background = "";    
      document.getElementById("btn-becas").style.background = "";    
      document.getElementById("btn-ambientes").style.background = "";  

    }
    
    target.classList.add("show-acordion");
  });
});
function hideContentAcordionAll() {
  btnOpenAccordionList.forEach(function (toggleButton) {
    var target = document.querySelector(
      toggleButton.getAttribute("data-target")
    );
    if (target.classList.contains("show-acordion")) {
      target.classList.remove("show-acordion");
    }
  });
}
var collapseElementList = document.querySelectorAll(
  '[data-toggle="collapse-arcjas"]'
);
var collapseList = Array.from(collapseElementList);

function hideAll(currentElement) {
  collapseList = Array.from(collapseElementList);
  collapseList.forEach(function (collapse) {
    var target = document.querySelector(collapse.getAttribute("data-target"));
    let titleElement = document.getElementById("title-" + target.id);

    if (target.classList.contains("show") && currentElement.id != target.id) {
      titleElement.style.background = "";

      target.classList.remove("show");
      target.classList.add("collapsing");
      target.style.height = "0px";
    }
  });
}

var toggleButtons = document.querySelectorAll(
  '[data-toggle="collapse-arcjas"]'
);

toggleButtons.forEach(function (toggleButton) {
  toggleButton.addEventListener("click", function () {
    console.log("--CLICK--");
    var target = document.querySelector(
      toggleButton.getAttribute("data-target")
    );
    console.log(target.id);
    let titleElement = document.getElementById("title-" + target.id);

    let currentElement = document.getElementById(target.id);
    hideAll(currentElement);
    if (target.classList.contains("show")) {
      titleElement.style.background = "";
      target.classList.remove("show");
      target.classList.add("collapsing");
      target.style.height = "0px";
      /*setTimeout(function () {
        target.classList.remove("collapsing");
        target.style.height = null;
        collapseList.forEach(function (collapse) {
          if (collapse !== target && collapse.classList.contains("show")) {
            collapse.classList.remove("show");
          }
        });
      }, 300);*/
    } else {
      target.classList.add("collapsing");
      titleElement.style.background = "#dddddd";
      target.style.display = "block";
      target.style.height = target.scrollHeight + "px";
      setTimeout(function () {
        target.classList.remove("collapsing");
        target.classList.add("show");
        target.style.height = null;
      }, 300);
    }
  });
});
