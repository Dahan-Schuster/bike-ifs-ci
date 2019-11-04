<div class="row">
    <span class="col-12">
        <h5 class="mb-0">Exclusão de registros</h5>
    </span>
</div>
<hr>
<div class="table-responsive">
    <table class="table table-sm responsive table-striped table-hover" id="tableRegistros" style="width: 100%">
        <caption style="caption-side: top">
            <div class="row">
                <div class="dropdown col-8 mb-2">
                    <button id="btnFiltro" class="btn btn-filtro" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="row">
                            <span class="col-11">Filtrar por...</span>
                            <span class="col-1"><i class="material-icons">filter_list</i></span>
                        </div>  
                    </button>
                    <div style="width: 95%; font-size: 14px; font-weight: 900" class="dropdown-menu dropdown-filtro" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-item dropdown-filtro-item">
                            <form id="formFiltro" class="px-2 pt-2 mb-0 w-100">
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="selectIntervalo" class="bmd-label-floating">Intervalo:</label>
                                        <select class="form-control form-control-sm" id="selectIntervalo">
                                            <option value="+1 months">Um mês</option>
                                            <option value="+2 months">Dois meses</option>
                                            <option value="+3 months">Três meses</option>
                                            <option value="+6 months">Seis meses</option>
                                            <option value="+1 years">Um ano</option>
                                            <option value="+2 years">Dois anos</option>
                                            <option value="+3 years">Três anos</option>
                                            <option value="+5 years">Cinco anos</option>
                                            <option value="todos" class="text-light bg-danger">Todos</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="inputDataInicial" class="bmd-label-floating mb-3">A partir de:</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control form-control-sm" id="inputDataInicial">
                                            <div class="input-group-append">
                                                <button type="button" class="btn" onclick="alert('Pesquise registros entre a data inicial e a quantidade de tempo escolhida')">
                                                    &quest;
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-8">
                                        <label for="selectFuncionarioCheckin" class="bmd-label-floating">Checkin feito por:</label>
                                        <select class="form-control form-control-sm" id="selectFuncionarioCheckin">
                                            <option value="todos">Qualquer funcionário</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 mt-4">
                                        <input type="checkbox" class="custom-switch hidden" id="switchApenasFuncionariosAtivosCheckin">
                                        <label class="custom-switch-label custom-switch-label-right" for="switchApenasFuncionariosAtivosCheckin"><span>Apenas ativos</span></label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-8">
                                        <label for="selectFuncionarioCheckout" class="bmd-label-floating">Checkout feito por:</label>
                                        <select class="form-control form-control-sm" id="selectFuncionarioCheckout">
                                            <option value="todos">Qualquer funcionário</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 mt-4">
                                        <input type="checkbox" class="custom-switch hidden" id="switchApenasFuncionariosAtivosCheckout">
                                        <label class="custom-switch-label custom-switch-label-right" for="switchApenasFuncionariosAtivosCheckout"><span>Apenas ativos</span></label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-md-8">
                                        <label for="selectTipoUsuario" class="bmd-label-floating">Tipo(s) de usuário:</label>
                                        <select class="form-control form-control-sm" id="selectTipoUsuario">
                                            <option value="todos">Qualquer tipo</option>
                                            <option value="aluno">Aluno</option>
                                            <option value="servidor">Servidor</option>
                                            <option value="visitante">Visitante</option>
                                            <option value="aluno_servidor">Aluno/Servidor</option>
                                            <option value="aluno_visitante">Aluno/Visitante</option>
                                            <option value="servidor_visitante">Servidor/Visitante</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 mt-4">
                                        <input type="checkbox" class="custom-switch hidden" id="switchApenasUsuariosAtivos">
                                        <label class="custom-switch-label custom-switch-label-right" for="switchApenasUsuariosAtivos"><span>Apenas ativos</span></label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="button" onclick="$('#btnFiltro').click()" class="btn btn-secondary">Cancelar</button>
                                    <button type="submit" class="btn btn-primary btn-raised ">Pesquisar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <button id="btnSelecionarLinhas" title="Selecionar todos" type="button" class="btn accent-color bmd-btn-fab bmd-btn-fab-sm text-light mr-3">
                        <i class="material-icons">check_box_outline_blank</i>
                    </button>
                    <button id="btnExcluirSelecionados" onclick="excluirRegistrosSelecionados()" title="Excluir selecionados" type="button" class="btn btn-danger bmd-btn-fab bmd-btn-fab-sm">
                        <i class="material-icons">delete</i>
                    </button>
                </div>
            </div>
        </caption>
        <thead class="bg-default-primary">
            <tr>
                <th>&#9432;</th>
                <th>Hora entrada</th>
                <th>Obs entrada</th>
                <th>Func. entrada</th>
                <th class="none">Nº trava:</th>
                <th>Bicicleta</th>
                <th>Usuário</th>
                <th class="none">Hora saída:</th>
                <th class="none">Obs saída:</th>
                <th class="none">Funcionário saída:</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <br>
</div>