    const select = document.getElementById('veiculo');
    const carImg = document.getElementById('carImg');
    const valorDiaria = document.getElementById('valorDiaria');
    select.addEventListener('change', e=>{
      const opt = select.selectedOptions[0];
      carImg.src = opt.dataset.img;
      valorDiaria.value = `R$ ${opt.dataset.preco},00`;

    });
