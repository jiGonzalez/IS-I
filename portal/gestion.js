function redireccionIndice() {
  location.href = "index.php";
}

function redireccionRegistro() {
  location.href = "registro.php";
}

function validarFormularioRegistro() {
  var a=document.forms["reg"]["nombre"].value;
  var b=document.forms["reg"]["apellido"].value;
  var c=document.forms["reg"]["correo"].value;
  var d=document.forms["reg"]["matricula"].value;
  var e=document.forms["reg"]["clave"].value;
  var f=document.forms["reg"]["conf"].value;
  if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d=="") && (e==null || e==""))
  {
    alert("Todos los campos son obligatorios.");
    return false;
  }
  if (a==null || a=="") {
    alert("Nombre es obligatorio.");
    return false;
  }
  if (b==null || b=="") {
    alert("Apellido es obligatorio.");
    return false;
  }
  if (c==null || c=="") {
    alert("Correo es obligatorio.");
    return false;
  }
  if (d==null || d=="") {
    alert("Matricula es obligatorio.");
    return false;
  }
  if (e==null || e=="") {
    alert("Contraseña es obligatorio.");
    return false;
  }
  if (e !== f) {
    alert("Contraseñas no coinciden.");
    return false;
  }
  return true;
}
