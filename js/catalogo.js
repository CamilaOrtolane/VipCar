  function alugarCarro(modelo, valor, imagem) {
    localStorage.setItem("modelo", modelo);
    localStorage.setItem("valor", valor);
    localStorage.setItem("imagem", imagem);
    window.location.href = "alugar.html";
  }