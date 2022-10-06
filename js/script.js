function recuperar() {
  /* if(document.getElementById("cPadrao").checked == true){ let valor = "1"
   ['<? =$selecionado= ?>'] = valor
}
   if(document.getElementById("ccavan").checked == true){ let valor = "2"

}
   if(document.getElementById("cadmin").checked == true){let valor = "3"

}*/
  window.Location.href("recuperar.php");
}

function toggleFullScreen() {
  if (
    (document.fullScreenElement && document.fullScreenElement !== null) ||
    (!document.mozFullScreen && !document.webkitIsFullScreen)
  ) {
    if (document.documentElement.requestFullScreen) {
      document.documentElement.requestFullScreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullScreen) {
      document.documentElement.webkitRequestFullScreen(
        Element.ALLOW_KEYBOARD_INPUT
      );
    }
  } else {
    if (document.cancelFullScreen) {
      document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
      document.webkitCancelFullScreen();
    }
  }
}
function requestFullScreen() {
  var el = document.body;

  // Suporta a maioria dos navegadores e suas versões.
  var requestMethod =
    el.requestFullScreen ||
    el.webkitRequestFullScreen ||
    el.mozRequestFullScreen ||
    el.msRequestFullScreen;

  if (requestMethod) {
    // Tela cheia nativa.
    requestMethod.call(el);
  } else if (typeof window.ActiveXObject !== "undefined") {
    // IE mais antigo.
    var wscript = new ActiveXObject("WScript.Shell");

    if (wscript !== null) {
      wscript.SendKeys("{F11}");
    }
  }
}
function frame(pages) {
  switch (pages) {
    case 0:
      document.getElementById("telas").src = "dashbord.php";
      break;
    case 1:
      document.getElementById("telas").src = "clientes.php";
      break;
    case 2:
      document.getElementById("telas").src = "funcionarios.php";
      break;
    case 3:
      document.getElementById("telas").src = "produtos.php";
      break;
    case 4:
      document.getElementById("telas").src = "fornecedor.php";
      break;
    case 5:
      document.getElementById("telas").src = "usuarios.php";
      break;
      case 6:
        document.getElementById("telas").src = "vendaautomatica.php";
        break;
    default:
      break;
  }
}

function pagina(relatorios) {
  window.location.href = "relatorios.php";
}
function graficoPizza() {
  var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
  var yValues = [55, 49, 44, 24, 15];
  var barColors = ["#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145"];

  new Chart("myChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [
        {
          backgroundColor: barColors,
          data: yValues,
        },
      ],
    },
    options: {
      title: {
        display: true,
        text: "World Wide Wine Production 2018",
      },
    },
  });
}
function graficoRosca() {
  var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
  var yValues = [55, 49, 44, 24, 15];
  var barColors = ["#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145"];

  new Chart("myChart", {
    type: "doughnut",
    data: {
      labels: xValues,
      datasets: [
        {
          backgroundColor: barColors,
          data: yValues,
        },
      ],
    },
    options: {
      title: {
        display: true,
        text: "World Wide Wine Production 2018",
      },
    },
  });
}
