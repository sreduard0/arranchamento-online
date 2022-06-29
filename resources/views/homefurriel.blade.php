@extends('layout')
@section('title', 'Início')
@section('home', 'active')
@section('title-header', 'Controle de adidos')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <script src="{{ asset('js/hide-form.js') }}"></script>
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
            visibility: hidden;
        }
    </style>
@endsection

@section('content')
    <section class="col ">
        <div class="row ">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="ata">0</h3>
                        <p class="bold">ATA</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-people"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="encostado">0</sup></h3>
                        <p class=" bold">ENCOSTADO</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-people"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="adido">0</h3>
                        <p class=" bold">ADIDO</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-people"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="reintegrado">0</h3>
                        <p class=" bold">REINTEGRADO</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-people"></i>
                    </div>

                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="form-group col">
                                <label for="condition_filter">Situação</label>
                                <select id="condition_filter" name="condition_filter" class="form-control">
                                    @foreach ($conditions as $condition)
                                        <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                                    @endforeach
                                    <option selected value="">TODAS AS SITUAÇÕES</option>
                                </select>
                            </div>
                            <button onclick="return search_condition()" style="height: 40px;"
                                class="btn btn-success m-t-30"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col">
                        <button class="float-r btn btn-success" data-toggle="modal"
                            data-target="#register">Adicionar</button>
                    </div>

                </div>



                <div id="button-print"></div>



            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="30px">Foto</th>
                            <th>P/G</th>
                            <th>Nome</th>
                            <th>Situação</th>
                            <th>Telefone</th>
                            <th>Padrinho</th>
                            <th width="140px">Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerLabel">Cadastrar (Ex) Militar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white"
                            style="background: url('{{ asset('img/bg-visitors.png') }}') center center;background-size:contain"
                            id="img_bg">
                            <div class="widget-user-image">
                                <img id="img_profile" class="img-circle" src="{{ asset('img/people.png') }}"
                                    alt="User Avatar">
                                <div class="panel-body">
                                    <label for="upload_image" class="btn btn-success edit-img-profile"><i
                                            class="fa fa-pen"></i></label>
                                    <input type="file" class="btn btn-success input-img-profile" name="upload_image"
                                        id="upload_image" accept="image/png,image/jpg,image/jpeg" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <span class="form-group col fs-20"><strong>Dados pessoais:</strong></span>
                        <div class="m-r-15">(Campos com * são obrigatórios)</div>
                    </div>

                    <form id="form-adido">
                        <div class="row">
                            <input type="hidden" id="image_profile" name="image_profile" value="">
                            <div class="form-group col">
                                <label for="condition_id">Situação *</label>
                                <select onclick="selectedata(this.value)" id="condition_id" name="condition_id"
                                    class="form-control">
                                    @foreach ($conditions as $condition)
                                        <option value="{{ $condition->id }}">{{ $condition->condition }}</option>
                                    @endforeach
                                    <option selected disabled value="">Selecione</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2 type" style="display:none;">
                                <label for="type">Tipo *</label>
                                <select onclick="selected(this.value)" id="type" name="type"
                                    class="form-control">
                                    <option selected value="0">Adm</option>
                                    <option value="1">Jud</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="speciality_id">Especialidade *</label>
                                <select id="speciality_id" name="speciality_id" class="form-control">
                                    @foreach ($specialitys as $speciality)
                                        <option value="{{ $speciality->id }}">{{ $speciality->speciality }}</option>
                                    @endforeach
                                    <option selected disabled value="">Selecione</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="company_id">CIA *</label>
                                <select id="company_id" name="company_id" class="form-control">
                                    @foreach ($companys as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                    <option selected disabled value="">Selecione</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="rank">P/G *</label>
                                <select id="rank" name="rank" class="form-control">
                                    @foreach ($ranks as $rank)
                                        <option value="{{ $rank->id }}">{{ $rank->rankAbbreviation }}</option>
                                    @endforeach
                                    <option selected disabled value="">Post/Grad</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="professionalName">Nome de guerra *</label>
                                <input id="professionalName" name="professionalName" type="text" class="form-control"
                                    placeholder="Nome de guerra">
                            </div>
                            <div class="form-group col">
                                <label for="fullName">Nome completo *</label>
                                <input id="fullName" name="fullName" type="text" class="form-control"
                                    placeholder="Nome completo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="idt_mil">IDT Militar / RA *</label>
                                <input type="text" class="form-control" name="idt_mil" id="idt_mil"
                                    placeholder="_________-_" value="">
                            </div>
                            <div class="col-md-3 form-group ">
                                <label for="cpf">CPF *</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['999.999.999-99']"
                                    inputmode="text" data-mask="" id="cpf" name="cpf" placeholder="CPF"
                                    value="">
                            </div>

                            <div class="col-md-3 form-group ">
                                <label for="phone">Telefone *</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['(99) 9 9999-9999']"
                                    inputmode="text" data-mask="" id="phone" name="phone"
                                    placeholder="Telefone" value="">
                            </div>


                            <div class="col-md-3 form-group ">
                                <label for="phone2">Telefone (Mãe,Pai,etc.)</label>
                                <input type="text" class="form-control" data-inputmask="'mask': ['(99) 9 9999-9999']"
                                    inputmode="text" data-mask="" id="phone2" name="phone2"
                                    placeholder="Telefone 2" value="">
                            </div>


                        </div>
                        <div class="showdiv" style="display:block;">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>Data de início *</label>
                                        <div class="input-group  date" id="startDate_" data-target-input="nearest">
                                            <input name="startDate" id="startDate" type="text"
                                                class="form-control datetimepicker-input" data-target="#startDate_"
                                                value="" placeholder="__-__-__">
                                            <div class="input-group-append" data-target="#startDate_"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="endDate">Quantidade de dias *</label>
                                    <input id="endDate" name="endDate" type="number" class="form-control"
                                        placeholder="Qtd de dias">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="seem">Parecer *</label>
                                    <input id="seem" name="seem" type="text" class="form-control"
                                        placeholder="Parecer">
                                </div>
                            </div>

                        </div>


                        <div class="hidediv" style="display:none;">
                            <div class="row">
                                <div class="col-md-3 form-group ">
                                    <label for="preccp">PREC-CP</label>
                                    <input type="text" class="form-control" data-inputmask="'mask': ['99 9999999']"
                                        inputmode="text" data-mask="" id="preccp" name="preccp"
                                        placeholder="PREC-CP" value="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="pis">PIS/PASEP</label>
                                    <input type="text" class="form-control"
                                        data-inputmask="'mask': ['999.99999.99-9']" inputmode="text" data-mask=""
                                        id="pis" name="pis" placeholder="PIS/PASEP" value="">
                                </div>

                                <div class="form-group col">
                                    <label for="godfather_id">Padrinho *</label>
                                    <select id="godfather_id" name="godfather_id" class="form-control">
                                        @foreach ($godfathers as $godfather)
                                            <option value="{{ $godfather->id }}">
                                                {{ $godfather->rank->rankAbbreviation }}
                                                {{ $godfather->professionalName }}
                                            </option>
                                        @endforeach
                                        <option selected disabled value="">Selecione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="godfather2_id">Substituto do padrinho *</label>
                                    <select id="godfather2_id" name="godfather_id2" class="form-control">
                                        @foreach ($godfathers as $godfather)
                                            <option value="{{ $godfather->id }}">
                                                {{ $godfather->rank->rankAbbreviation }}
                                                {{ $godfather->professionalName }}
                                            </option>
                                        @endforeach
                                        <option selected disabled value="">Selecione</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>Data de praça *</label>
                                        <div class="input-group  date" id="joinedArmy_" data-target-input="nearest">
                                            <input name="joinedArmy" id="joinedArmy" type="text"
                                                class="form-control datetimepicker-input" data-target="#joinedArmy_"
                                                value="" placeholder="__-__-__">
                                            <div class="input-group-append" data-target="#joinedArmy_"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>Data de licenciamento *</label>
                                        <div class="input-group  date" id="licensing_" data-target-input="nearest">
                                            <input name="licensing" id="licensing" type="text"
                                                class="form-control datetimepicker-input" data-target="#licensing_"
                                                value="" placeholder="__-__-__">
                                            <div class="input-group-append" data-target="#licensing_"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-md-5">
                                    <label>Data de reintegrado/encostado/adido *</label>
                                    <div class="input-group  date" id="reinstated_" data-target-input="nearest">
                                        <input name="reinstated" id="reinstated" type="text"
                                            class="form-control datetimepicker-input" data-target="#reinstated_"
                                            value="" placeholder="__-__-__">
                                        <div class="input-group-append" data-target="#reinstated_"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="reason">Motivo / Obs. *</label>
                                <textarea class="form-control new_menu" name="reason" id="reason" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="reform" style="display:none;">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>Data da port. reforma</label>
                                        <div class="input-group  date" id="dateReformOrdinace_"
                                            data-target-input="nearest">
                                            <input name="dateReformOrdinace" id="dateReformOrdinace" type="text"
                                                class="form-control datetimepicker-input"
                                                data-target="#dateReformOrdinace_" value="" placeholder="__-__-__">
                                            <div class="input-group-append" data-target="#dateReformOrdinace_"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>Data DOU reforma</label>
                                        <div class="input-group  date" id="dateDOUReform_" data-target-input="nearest">
                                            <input name="dateDOUReform" id="dateDOUReform" type="text"
                                                class="form-control datetimepicker-input" data-target="#dateDOUReform_"
                                                value="" placeholder="__-__-__">
                                            <div class="input-group-append" data-target="#dateDOUReform_"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label>Data de nascimento</label>
                                        <div class="input-group  date" id="birthDate_" data-target-input="nearest">
                                            <input name="birthDate" id="birthDate" type="text"
                                                class="form-control datetimepicker-input" data-target="#birthDate_"
                                                value="" placeholder="__-__-__">
                                            <div class="input-group-append" data-target="#birthDate_"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="address">Endereço </label>
                                    <input id="address" name="address" type="text" class="form-control"
                                        placeholder="Endereço completo">
                                </div>
                            </div>
                        </div>

                        <div class="proceduraldate" style="display:none;">
                            <div class="row">
                                <span class="form-group col fs-20"><strong>Dados processuais:</strong></span>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="process1">Processo 1º Grau</label>
                                    <input id="process1" name="process1" type="text" class="form-control"
                                        placeholder="Processo 1º Grau">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="key1">Chave 1</label>
                                    <input id="key1" name="key1" type="text" class="form-control"
                                        placeholder="Chave 1">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="process2">Processo 2º Grau *</label>
                                    <input id="process2" name="process2" type="text" class="form-control"
                                        placeholder="Processo 2º Grau">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="key2">Chave 2 *</label>
                                    <input id="key2" name="key2" type="text" class="form-control"
                                        placeholder="Chave 2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="attorney">Nome do advogado *</label>
                                    <input id="attorney" name="attorney" type="text" class="form-control"
                                        placeholder="Nome do advogado">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="nameLawyerOffice">Nome do escritório *</label>
                                    <input id="nameLawyerOffice" name="nameLawyerOffice" type="text"
                                        class="form-control" placeholder="Nome do escritório">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="court_judge">Vara federal / Juiz *</label>
                                    <input id="court_judge" name="court_judge" type="text" class="form-control"
                                        placeholder="Vara federal / Juiz">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="class_judge">Turma TRF4 / Desembargador Relator *</label>
                                    <input id="class_judge" name="class_judge" type="text" class="form-control"
                                        placeholder="Turma TRF4 / Desembargador Relator">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="doctorResponsible">Med. responsavel laudo de reintegração *</label>
                                    <input id="doctorResponsible" name="doctorResponsible" type="text"
                                        class="form-control" placeholder="Med. responsavel laudo de reintegração">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="thresholdDecision">Decisão limiar *</label>
                                    <textarea class="form-control new_menu " name="thresholdDecision" id="thresholdDecision" cols="30"
                                        rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="judicialExpertise">Pericia judicial *</label>
                                    <textarea class="form-control new_menu " name="judicialExpertise" id="judicialExpertise" cols="30"
                                        rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="verdict">Sentença *</label>
                                    <textarea class="form-control new_menu " name="verdict" id="verdict" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="appeal">Apelação *</label>
                                    <textarea class="form-control new_menu " name="appeal" id="appeal" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="responsibleMenu">Responsavel ementa *</label>
                                    <textarea class="form-control new_menu " name="responsibleMenu" id="responsibleMenu" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="specialResource">Recurso especial </label>
                                    <textarea class="form-control new_menu " name="specialResource" id="specialResource" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="extraordinaryResource">Recurso extraordinário </label>
                                    <textarea class="form-control new_menu " name="extraordinaryResource" id="extraordinaryResource" cols="30"
                                        rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="comment">Observações *</label>
                                    <textarea class="form-control new_menu " name="comment" id="comment" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="legalGuidance">Orientação jurídica *</label>
                                    <textarea class="form-control new_menu " name="legalGuidance" id="legalGuidance" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="guardianship">Tutela deferida</label>
                                    <select id="guardianship" name="guardianship" class="form-control">
                                        <option value="1">Sim</option>
                                        <option selected value="0">Não</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="unusual">Inaudita</label>
                                    <select id="unusual" name="unusual" class="form-control">
                                        <option value="1">Sim</option>
                                        <option selected value="0">Não</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="judgment">Trânsito em julgado</label>
                                    <select id="judgment" name="judgment" class="form-control">
                                        <option value="1">Sim</option>
                                        <option selected value="0">Não</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="situation">Situação processo</label>
                                    <select id="situation" name="situation" class="form-control">
                                        <option value="1">Em andamento</option>
                                        <option value="2">Arquivado</option>
                                        <option value="3">Baixado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick="return add_adido()">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de envio de imagem --}}
    <div id="uploadimage" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ajustar imagem</h4>
                </div>
                <div class="modal-body">
                    <div id="image_demo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button class="btn btn-success crop_image">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    @include('visitor_profile')
@endsection
@section('plugins')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/numeric-comma.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/inputmask.js') }}"></script>
    <script src="{{ asset('js/crop-img-profile.js') }}"></script>

    <script>
        $(function() {
            var url = '/get_qtt_licensing';
            $.get(url, function(result) {
                document.getElementById('ata').innerText = result.ata;
                document.getElementById('reintegrado').innerText = result.reintegrado;
                document.getElementById('encostado').innerText = result.encostado;
                document.getElementById('adido').innerText = result.adido;
            })
        });
        $(function() {
            $("#table").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0, 4, 5, 6]
                }],
                "language": {
                    "url": "{{ asset('plugins/datatables/Portuguese2.json') }}"
                },
                "processing": true,
                "serverSide": true,

                "ajax": {
                    "url": "{{ route('get_adidos') }}",
                    "type": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                },
                "dom": "Bfrtip",
                "lengthMenu": [
                    [10, 25, 50, 100, 100000],
                    ["10", "25", "50", "100", "Todos"],
                ],
                "buttons": [{
                        "extend": "print",
                        "text": "Imprimir",
                        'messageTop': " {{ session('user')['name'] }} -  {{ session('user')['rank'] }}",
                        'messageBottom': 'Seção de Saúde',
                        'exportOptions': {
                            'columns': [1, 2, 3, 4, 5]
                        },
                        "autoPrint": true,
                    },
                    {
                        "extend": "pageLength",
                        "text": "Exibir",
                    },
                ],
            });
            // Summernote
            $('.new_menu').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font'],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table'],
                ]
            });

        });
    </script>

@endsection
