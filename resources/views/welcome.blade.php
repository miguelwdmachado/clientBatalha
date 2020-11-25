@extends('layouts.template_home')
<?php $po = 400; ?>
@section('head')
<title>Batalha Humano x Orc</title>
@endsection

@section('header')
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,800,500" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Calligraffitti&display=swap" rel="stylesheet">
@endsection

@section('section1')
<section>

  <div class="container-fluid">
    <div class="row align-items-center center">
      <div class="col-md-3 col-lg-3 col-xl-3 dvimgl" style="padding: 60px;">
        <span class="text-center" style="text-decoration: underline;"><b><h3>Humano</h3></b></span><br><h4>
        <p style="line-height: 1.8;" id="hagilidade">Agilidade: 0</p>
        <p style="line-height: 1.8;" id="hforca">Força: 0</p>
        <p style="line-height: 1.8;" id="hataque">Ataque: 0</p>
        <p style="line-height: 1.8;" id="hdefesa">Defesa: 0</p>
        <p style="line-height: 1.8;" id="hvidas">Vidas: 0</p>
        </h4>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-6 text-center align-items-center" id="mtela">
        <input type="image" class="botao" id="ijogo" alt="Iniciar o jogo" src="/images/btn_iniciar_jogo.png" onclick="iniciar_jogo()" style="display: none">
        <input type="image" class="botao" id="idados" alt="Rolar os dados" src="/images/btn_rolar_dado.png" style="display: none" onclick="rolar_dados_escolha()">
        <input type="image" class="botao" id="irodada" alt="Iniciar Rodada" src="/images/btn_iniciar_rodada.png" onclick="iniciar_rodada()" style="display: none">
        <input type="image" class="botao" id="ahumano" alt="Ataque Humano" src="/images/btn_ataque_humano.png" style="display: none" onclick="atacante_ataque_humano()">
        <input type="image" class="botao" id="aorc" alt="Ataque Orc" src="/images/btn_ataque_orc.png" style="display: none" onclick="atacante_ataque_orc()">
        <audio id="rdados" src="/sounds/rolar_dados.mp3" preload="auto"></audio>
        <audio id="respada" src="/sounds/espada.mp3" preload="auto"></audio>
        <audio id="rclava" src="/sounds/clava.mp3" preload="auto"></audio>
      </div>
      <div class="col-md-3 col-lg-3 col-xl-3 dvimgl" style="padding: 60px; line-height: 1.8;">
        <span class="text-center" style="text-decoration: underline;"><b><h3>Orc</h3></b></span><br><h4>
          <p style="line-height: 1.8;" id="oagilidade">Agilidade: 0</p>
          <p style="line-height: 1.8;" id="oforca">Força: 0</p>
          <p style="line-height: 1.8;" id="oataque">Ataque: 0</p>
          <p style="line-height: 1.8;" id="odefesa">Defesa: 0</p>
          <p style="line-height: 1.8;" id="ovidas">Vidas: 0</p>
        </h4>
      </div>
    </div>
  </div>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(function(){
  localStorage.clear();
  $('#ijogo').show();
});

function iniciar_jogo(){
  $.ajax({
    data: {
      '_token': '{{csrf_token()}}'
    },
    type: "GET",
    async: true,
    url: "http://apibatalha.com.br/api/inicia_partida",
    success: function(data) {
      localStorage.setItem('id_partida', data[0].id_partida);
      localStorage.setItem('ovida', data[0].ovida);
      localStorage.setItem('oforca', data[0].oforca);
      localStorage.setItem('oataque', data[0].oataque);
      localStorage.setItem('odefesa', data[0].odefesa);
      localStorage.setItem('oagilidade', data[0].oagilidade);
      localStorage.setItem('hvida', data[0].hvida);
      localStorage.setItem('hforca', data[0].hforca);
      localStorage.setItem('hataque', data[0].hataque);
      localStorage.setItem('hdefesa', data[0].hdefesa);
      localStorage.setItem('hagilidade', data[0].hagilidade);
      $('#hagilidade').empty();
      $('#hforca').empty();
      $('#hataque').empty();
      $('#hdefesa').empty();
      $('#hvidas').empty();
      $('#hagilidade').html('Agilidade: '+localStorage.getItem('hagilidade'));
      $('#hforca').html('Força: '+localStorage.getItem('hforca'));
      $('#hataque').html('Ataque: '+localStorage.getItem('hataque'));
      $('#hdefesa').html('Defesa: '+localStorage.getItem('hdefesa'));
      $('#hvidas').html('Vidas: '+localStorage.getItem('hvida'));

      $('#oagilidade').empty();
      $('#oforca').empty();
      $('#oataque').empty();
      $('#odefesa').empty();
      $('#ovidas').empty();
      $('#oagilidade').html('Agilidade: '+localStorage.getItem('oagilidade'));
      $('#oforca').html('Força: '+localStorage.getItem('oforca'));
      $('#oataque').html('Ataque: '+localStorage.getItem('oataque'));
      $('#odefesa').html('Defesa: '+localStorage.getItem('odefesa'));
      $('#ovidas').html('Vidas: '+localStorage.getItem('ovida'));
      $('#ijogo').hide();
      $("#mbody").html('Prepare-se!<br>Agora, você deverá rolar os dados para ver quem irá começar a rodada');
      $("#exampleModalCenter").modal({show: true});
      $('#idados').show();
    },
    error: function(error) {
      console.log(error);
    }
})
}

function rolar_dados_escolha(){
  clearTimeout(setTimeout($('#rdados')[0].play(),5000));
  passo = 0;
    $.ajax({
      data: {
        '_token': '{{csrf_token()}}',
        'id_partida': localStorage.getItem('id_partida')
      },
      type: "GET",
      async: true,
      url: "http://apibatalha.com.br/api/escolhe_inicio",
      success: function(data) {
        var mensagem = data[0].message;
        var dadoh = data[0].dadoh;
        var dadoo = data[0].dadoo;
        if (mensagem == 'Humano Inicia Rodada!') {
          mensagem = 'Humano: '+dadoh+' pontos<br>Orc: '+dadoo+' pontos<br>Humano Inicia Rodada!';
          var atacante = 'h';
          $("#mbody").empty();
          $("#mbody").html(mensagem);
          $('#idados').hide();
          $("#exampleModalCenter").modal({show: true});
          $('#ahumano').show();
        } else {
          mensagem = 'Orc: '+dadoo+' pontos<br>Humano: '+dadoh+' pontos<br>Orc Inicia Rodada!';
          var atacante = 'o';
          $("#mbody").empty();
          $("#mbody").html(mensagem);
          $('#idados').hide();
          $("#exampleModalCenter").modal({show: true});
          $('#aorc').show();
        }
        },
        error: function(error) {
          console.log(error);
        }
  });
}

function atacante_ataque_humano() {
  clearTimeout(setTimeout($('#respada')[0].play(),5000));
  $.ajax({
    data: {
      '_token': '{{csrf_token()}}',
      'id_partida': localStorage.getItem('id_partida')
    },
    type: "GET",
    async: true,
    url: "http://apibatalha.com.br/api/ataque_humano",
    success: function(data) {
      passo++;
      var vencedor = data[0].vencedor;
      if (vencedor == 'ah') {
        var hta = data[0].hta;
        var otd = data[0].otd;
        var odano = data[0].dano;
        var hvida = localStorage.getItem('hvida');
        var ovida = localStorage.getItem('ovida');
        var ovida = ovida - odano;
        localStorage.setItem('ovida', ovida);
        $('#ovidas').empty();
        $('#ovidas').html('Vidas: '+ovida);
        $('#ahumano').hide();
        $('#aorc').hide();
        mensagem = 'Humano: '+hta+' pontos<br>Orc: '+otd+' pontos<br>Atacante vence rodada!<br>Dano sofrido pelo Orc: '+odano+'<br>';
        $("#mbody").empty();
        $("#mbody").html(mensagem);
        $("#exampleModalCenter").modal({show: true});
        if (passo > 2) {
          $('#ahumano').hide();
          $('#aorc').hide();
          $('#idados').hide();
          $("#mbody").empty();
          $("#mbody").html('Prepare-se!<br>Agora, você deverá rolar os dados para ver quem irá começar a rodada');
          $("#exampleModalCenter").modal({show: true});
          $('#idados').show();
        } else {
        $('#aorc').show();
        }
        } else {
        var hta = data[0].hta;
        var otd = data[0].otd;
        var dano = 0;
        var ovida = localStorage.getItem('ovida');
        var hvida = localStorage.getItem('hvida');
        $('#ahumano').hide();
        $('#aorc').hide();
        $('#idados').hide();
        mensagem = 'Humano: '+hta+' pontos<br>Orc: '+otd+' pontos<br>Defensor vence rodada!<br>Nenhum dano sofrido pelo Orc<br>';
        $("#mbody").empty();
        $("#mbody").html(mensagem);
        $("#exampleModalCenter").modal({show: true});
        if (passo > 2) {
          $('#ahumano').hide();
          $('#aorc').hide();
          $('#idados').hide();
          $("#mbody").empty();
          $("#mbody").html('Prepare-se!<br>Agora, você deverá rolar os dados para ver quem irá começar a rodada');
          $("#exampleModalCenter").modal({show: true});
          $('#idados').show();
        } else {
        $('#aorc').show();
        }
        if (ovida < 1) {
          mensagem = 'Humano<br>É o vencedor da Partida!<br>';
          $('#ahumano').hide();
          $('#aorc').hide();
          $('#idados').hide();
          $('#ijogo').show();
          $("#mbody").empty();
          $("#mbody").html(mensagem);
          $('#hagilidade').empty();
          $('#hforca').empty();
          $('#hataque').empty();
          $('#hdefesa').empty();
          $('#hvidas').empty();
          $('#hagilidade').html('Agilidade: 0');
          $('#hforca').html('Força: 0');
          $('#hataque').html('Ataque: 0');
          $('#hdefesa').html('Defesa: 0');
          $('#hvidas').html('Vidas: 0');

          $('#oagilidade').empty();
          $('#oforca').empty();
          $('#oataque').empty();
          $('#odefesa').empty();
          $('#ovidas').empty();
          $('#oagilidade').html('Agilidade: 0');
          $('#oforca').html('Força: 0');
          $('#oataque').html('Ataque: 0');
          $('#odefesa').html('Defesa: 0');
          $('#ovidas').html('Vidas: 0');
        }
      }
      },
      error: function(error) {
        console.log(error);
      }
});
}

function atacante_ataque_orc() {
  clearTimeout(setTimeout($('#rclava')[0].play(),5000));
  $.ajax({
    data: {
      '_token': '{{csrf_token()}}',
      'id_partida': localStorage.getItem('id_partida')
    },
    type: "GET",
    async: true,
    url: "http://apibatalha.com.br/api/ataque_orc",
    success: function(data) {
      passo++;
      var vencedor = data[0].vencedor;
      if (vencedor == 'ao') {
        var ota = data[0].ota;
        var htd = data[0].htd;
        var hdano = data[0].dano;
        var hvida = localStorage.getItem('hvida');
        var ovida = localStorage.getItem('ovida');
        var hvida = hvida - hdano;
        localStorage.setItem('hvida', hvida);
        $('#hvidas').empty();
        $('#hvidas').html('Vidas: '+hvida);
        $('#ahumano').hide();
        $('#aorc').hide();
        $('#idados').hide();
        mensagem = 'Orc: '+ota+' pontos<br>Humano: '+htd+' pontos<br>Atacante vence rodada!<br>Dano sofrido pelo Humano: '+hdano+'<br>';
        $("#mbody").empty();
        $("#mbody").html(mensagem);
        $("#exampleModalCenter").modal({show: true});
        if (passo > 2) {
          $('#ahumano').hide();
          $('#aorc').hide();
          $('#idados').hide();
          $("#mbody").empty();
          $("#mbody").html('Prepare-se!<br>Agora, você deverá rolar os dados para ver quem irá começar a rodada');
          $("#exampleModalCenter").modal({show: true});
          $('#idados').show();
        } else {
        $('#ahumano').show();
        }
        } else {
        var ota = data[0].ota;
        var htd = data[0].htd;
        var dano = 0;
        var hvida = localStorage.getItem('hvida');
        var ovida = localStorage.getItem('ovida');
        $('#ahumano').hide();
        $('#aorc').hide();
        $('#idados').hide();
        mensagem = 'Humano: '+htd+' pontos<br>Orc: '+ota+' pontos<br>Defensor vence rodada!<br>Nenhum dano sofrido pelo Humano<br>';
        $("#mbody").empty();
        $("#mbody").html(mensagem);
        $("#exampleModalCenter").modal({show: true});
        if (passo > 2) {
          $('#ahumano').hide();
          $('#aorc').hide();
          $('#idados').hide();
          $("#mbody").empty();
          $("#mbody").html('Prepare-se!<br>Agora, você deverá rolar os dados para ver quem irá começar a rodada');
          $("#exampleModalCenter").modal({show: true});
          $('#idados').show();
        } else {
        $('#ahumano').show();
        }
        if (hvida < 1) {
          mensagem = 'Orc<br>É o vencedor da Partida!<br>';
          $('#ahumano').hide();
          $('#aorc').hide();
          $('#idados').hide();
          $('#ijogo').show();
          $("#mbody").empty();
          $("#mbody").html(mensagem);
          $('#hagilidade').empty();
          $('#hforca').empty();
          $('#hataque').empty();
          $('#hdefesa').empty();
          $('#hvidas').empty();
          $('#hagilidade').html('Agilidade: 0');
          $('#hforca').html('Força: 0');
          $('#hataque').html('Ataque: 0');
          $('#hdefesa').html('Defesa: 0');
          $('#hvidas').html('Vidas: 0');

          $('#oagilidade').empty();
          $('#oforca').empty();
          $('#oataque').empty();
          $('#odefesa').empty();
          $('#ovidas').empty();
          $('#oagilidade').html('Agilidade: 0');
          $('#oforca').html('Força: 0');
          $('#oataque').html('Ataque: 0');
          $('#odefesa').html('Defesa: 0');
          $('#ovidas').html('Vidas: 0');
        }
      }
      },
      error: function(error) {
        console.log(error);
      }
});
}

</script>
</endsection
