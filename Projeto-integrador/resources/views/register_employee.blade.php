@extends('layout')

@section('document')
    Registrar Funcionário
@endsection


@section('content')
<link rel="stylesheet" href="{{asset('css/styles_cadastrar.css')}}">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">



@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (isset($employee->id) and $employee->id)
        <form class="employee-form" action="{{route("update", $employee)}}" enctype="multipart/form-data" method="post">
            @method('PUT')
    @else
        
        <form class="employee-form" action="{{route('store')}}" enctype="multipart/form-data" method="post">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    @endif
    @csrf
    <div class="hr-text">Dados Pessoais</div>
    <!-- Foto de Perfil -->
    <label>Foto de Perfil</label>
    <div class="photo-preview" id="photo-preview">Prévia da Foto</div>
    <input type="file" name="profile_pic" accept="image/*" onchange="previewFoto(this)" value="{{$employee->photo ?? ' '}}" required>

    <!-- Currículo -->
    <label>Currículo</label>
    <input type="file" name="curriculum" accept=".pdf,.doc,.docx" value="{{$employee->curriculum ?? ' '}}" required>

    <label>Nome</label>
    <input type="text" name="name" value="{{$employee->name ?? " "}}">

    <label>CPF</label>
    <input type="text" name="cpf" oninput="mascaraCPF(this)" value="{{$employee->cpf ?? " "}}">

    <label>RG</label>
    <input type="text" name="rg" id="rg" value="{{$employee->rg ?? " "}}" oninput="mascaraRG(this)" >

    <label>Data de Nascimento</label>
    <input type="date" name="birth_date" value="{{$employee->birth_date ?? " "}}">

    <label>Email</label>
    <input type="email" name="email" value="{{$employee->email ?? " "}}">

    <label>Telefone</label>
    <input type="text" name="phone" oninput="mascaraTelefone(this)" value="{{$employee->phone ?? " "}}">

    <label>Sexo</label>
    <select name="gender" value="{{$employee->gender ?? " "}}">
        <option>Masculino</option>
        <option>Feminino</option>
        <option>Outro</option>
    </select>

    <label>Estado Civil</label>
    <select name="marital_status" value="{{$employee->marital_status ?? " "}}">
        <option>Solteiro(a)</option>
        <option>Casado(a)</option>
        <option>Divorciado(a)</option>
        <option>Viúvo(a)</option>
    </select>

    <label>Quantidade de Filhos</label>
    <input class="form-control" type="number" name="children" value="{{$employee->children ?? " "}}">

    <label>Cep</label>
    <input type="text" id="cep" name="cep" value="{{ $employee->address->cep ?? '' }}">

    <label>Estado</label>
    <input type="text" id="state" name="state" value="{{ $employee->address->state ?? '' }}">
    <label>Cidade</label>
    <input type="text" id="city" name="city" value="{{ $employee->address->city ?? '' }}">
    <label>Logradouro</label>
    <input type="text" id="street" name="street" value="{{ $employee->address->street ?? '' }}">
    <label>Número</label>
    <input type="text" name="number" value="{{ $employee->address->number ?? '' }}">


    <label>PCD (Pessoa com Deficiência)</label>
    <div style="display: flex; align-items: center; gap: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
        <div style="display: flex; align-items: center;">
            <input type="radio" id="pcd_sim" name="pwd" value="1" style="margin-right: 6px;">
            <label for="pcd_sim">Sim</label>
        </div>
        <div style="display: flex; align-items: center;">
            <input type="radio" id="pcd_nao" name="pwd" value="0" style="margin-right: 10px;">
            <label for="pcd_nao">Não</label>
        </div>
    </div>

    <div class="hr-text">Área de Atuação</div>
    <label>Departamento</label>
    <select name="name">
        <option></option>
        <option>Administração</option>
        <option>Suporte</option>
        <option>T.I</option>
        <option>Estágio</option>
        <option>Recursos Humanos</option>
        <option>Marketing</option>
        <option>Vendas</option>
        <option>Financeiro</option>
        <option>Comercial</option>
        <option>Design</option>
        <option>Desenvolvimento</option>
        <option>Gestão de Projetos</option>
        <option>Logística</option>
        <option>Atendimento ao Cliente</option>
        <option>Jurídico</option>
        <option>Operações</option>
        <option>Engenharia</option>
        <option>Produção</option>
        <option>Pesquisa e Desenvolvimento</option>
        <option>Qualidade</option>
        <option>Gestão de Pessoas</option>
    </select>

    <label>Cargo</label>
    <input type="text" name="position">

    <label>Data de Admissão</label>
    <input type="date" name="admission_date">

    <label>Salário</label>
    <input type="text" name="salary" placeholder="R$0,00" onInput="maskMoney(event);" />

    <label>Status do Colaborador</label>
    <select name="employee_stats">
        <option>Ativo</option>
        <option>Inativo</option>
        <option>Desligado</option>
    </select>

    <label>Número da CTPS</label>
    <input type="text" name="CTPS_number">

    <label>Série da CTPS</label>
    <input type="text" name="CTPS_series">

    <label>PIS/PASEP</label>
    <input type="text" name="PIS_PASEP">

    <div class="hr-text">Dados Bancários</div>
    <label>Banco</label>
    <input type="text" name="bank_name">

    <label>Agência</label>
    <input type="text" name="bank_agency">

    <label>Número da Conta</label>
    <input type="text" name="bank_account">

    <label>Tipo de Conta</label>
    <select name="account_type">
        <option>Corrente</option>
        <option>Poupança</option>
    </select>

    <label>Observações</label>
    <textarea name="observations" style="opacity: 0.5;" placeholder="Caso tenha alguma deficiência ou queira adicionar algo a mais, pode usar este campo."></textarea>
    <button type="submit" style="background-color: #1a2b49; width: 100%;">Salvar</button>

</form>


    


<script>
$(function(){
   $('#cep').mask('00000-000')
})




function mascaraRG(input) {
  let valor = input.value.replace(/\D/g, '');

  if (valor.length > 8) {
    valor = valor.substring(0, 8);
  }

  input.value = valor;
}
const maskMoney = (e) => {
      const onlyDigits = e.target.value
        .split("") // divide por ""
        .filter(num => /\d/.test(num)) 
        .join("") // retorna numa string
        .padStart(3, "0");

      const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2);
      e.target.value = dinheiro(digitsFloat);
    };

    const dinheiro = (valor, locale = 'pt-BR', currency = 'BRL') => {
      
      return new Intl.NumberFormat(locale, {
        style: 'currency',
        currency
      }).format(valor);
    };





</script>
<script src="{{asset('scripts/jquery-3.7.1.min.js')}}"></script>

<script src="{{asset('scripts/jquery.mask.min.js')}}"></script>
<script src="{{asset('scripts/cep.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection