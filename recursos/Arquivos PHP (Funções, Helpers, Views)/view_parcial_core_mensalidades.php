<form class="forms-sample" name="form_core" method="post">

                            <div class="row mb-3">

                                <div class="col-md-8 mb-3">

                                    <label for="">Mensalista</label>
                                    <select class="form-control mensalistas select2" name="mensalidade_mensalista_id" <?php echo (isset($mensalidade) ? 'disabled' : ''); ?>>

                                        <option value="">Escolha...</option>


                                        <?php foreach ($mensalistas as $mensalista): ?>

                                            <?php if (isset($mensalidade)): ?>

                                                <option value="<?php echo $mensalista->mensalista_id . ' ' . $mensalista->mensalista_dia_vencimento ?>" <?php echo ($mensalista->mensalista_id == $mensalidade->mensalidade_mensalista_id ? 'selected' : '') ?>><?php echo $mensalista->mensalista_nome . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;CPF&nbsp&nbsp;' . $mensalista->mensalista_cpf; ?></option>                                                

                                            <?php else: ?>

                                                <option value="<?php echo $mensalista->mensalista_id . ' ' . $mensalista->mensalista_dia_vencimento ?>"><?php echo $mensalista->mensalista_nome . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;CPF&nbsp&nbsp;' . $mensalista->mensalista_cpf; ?></option>

                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('mensalidade_mensalista_id', '<div class="text-danger">', '</div>') ?>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="">Melhor dia de vencimento</label>
                                    <input type="text" class="form-control mensalista_dia_vencimento" name="mensalidade_mensalista_dia_vencimento" value="<?php echo (isset($mensalidade) ? $mensalidade->mensalidade_mensalista_dia_vencimento : set_value('mensalidade_mensalista_dia_vencimento')) ?>" readonly="">
                                    <?php echo form_error('mensalidade_mensalista_dia_vencimento', '<div class="text-danger">', '</div>') ?>
                                </div>

                            </div>

                            <div class="row mb-3">

                                <div class="col-md-8 mb-3">
                                    <label for="">Categoria</label>
                                    <select class="form-control precificacao select2" name="mensalidade_precificacao_id" <?php echo (isset($mensalidade) && $mensalidade->mensalidade_status == 1 ? 'disabled' : ''); ?>>

                                        <option value="">Escolha...</option>

                                        <?php foreach ($precificacoes as $preco): ?>

                                            <?php if (isset($mensalidade)): ?>

                                                <option value="<?php echo $preco->precificacao_id . ' ' . $preco->precificacao_valor_mensalidade ?>" <?php echo ($preco->precificacao_id == $mensalidade->mensalidade_precificacao_id ? 'selected' : '') ?>><?php echo $preco->precificacao_categoria ?></option>                                                

                                            <?php else: ?>

                                                <option value="<?php echo $preco->precificacao_id . ' ' . $preco->precificacao_valor_mensalidade ?>"><?php echo $preco->precificacao_categoria ?></option>

                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('mensalidade_precificacao_id', '<div class="text-danger">', '</div>') ?>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="">Valor mensalidade</label>
                                    <input type="text" class="form-control mensalidade_valor_mensalidade" name="mensalidade_valor_mensalidade" value="<?php echo (isset($mensalidade->mensalidade_valor_mensalidade) ? $mensalidade->mensalidade_valor_mensalidade : '0,00') ?>" readonly="">
                                </div>

                            </div>

                            <div class="row mb-3">


                                <div class="col-md-4 mb-3">
                                    <label for="">Data vencimento</label>
                                    <input type="date" class="form-control" name="mensalidade_data_vencimento" value="<?php echo (isset($mensalidade) ? $mensalidade->mensalidade_data_vencimento : set_value('mensalidade_data_vencimento')) ?>" <?php echo (isset($mensalidade) ? 'disabled' : ''); ?>>
                                    <?php echo form_error('mensalidade_data_vencimento', '<div class="text-danger">', '</div>') ?>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="">Situação</label>

                                    <select class="form-control" name="mensalidade_status" <?php echo (isset($mensalidade) && $mensalidade->mensalidade_status == 1 ? 'disabled' : ''); ?>>
                                        <?php if (isset($mensalidade)): ?>

                                            <option value="0" <?php echo ($mensalidade->mensalidade_status == 0 ? 'selected' : '') ?>>Pendente</option>
                                            <option value="1" <?php echo ($mensalidade->mensalidade_status == 1 ? 'selected' : '') ?>>Paga</option>

                                        <?php else: ?>

                                            <option value="0">Pendente</option>
                                            <option value="1">Paga</option>

                                        <?php endif; ?>

                                    </select>

                                </div>

                                <?php if (isset($mensalidade) && $mensalidade->mensalidade_status == 1): ?>
                                    <div class="col-md-4 mb-3">
                                        <label for="">Data do pagamento</label>
                                        <input type="text" class="form-control" value="<?php echo formata_data_banco_com_hora($mensalidade->mensalidade_data_pagamento); ?>" readonly="">
                                    </div>
                                <?php endif; ?>

                            </div>



                            <?php if (isset($mensalidade)): ?>
                                <input type="hidden" name="mensalidade_id" value="<?php echo $mensalidade->mensalidade_id ?>"/>
                            <?php endif; ?>
                            <input type="hidden" class="mensalidade_mensalista_id" name="mensalidade_mensalista_hidden_id" value=""/>
                            <input type="hidden" class="mensalidade_precificacao_id" name="mensalidade_precificacao_hidden_id" value=""/>


                            <?php if (isset($mensalidade) && $mensalidade->mensalidade_status == 1): ?>
                                <button type="submit" class="btn btn-success mr-2" disabled="">Encerrada</button>
                            <?php else: ?>
                                <a title="Cadastrar mensalidade" href="javascript:void(0)" class="btn btn btn-primary mr-2" data-toggle="modal" data-target="#mensalidade">Salvar</i></a>                            
                            <?php endif; ?>

                            <a href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-light">Voltar</a>

                            <div class="modal fade" id="mensalidade" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="demoModalLabel"><i class="ik ik-alert-octagon text-danger"></i>&nbsp;&nbsp;Confirmação de dados!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <span class="text-dark font-weight-bold"><?php echo $texto_modal; ?></span></br>
                                            <p></p>
                                            Clique em <span class="text-primary font-weight-bold">"Sim"</span> para <?php echo $valor_btn ?>.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
                                            <button type="submit" class="btn btn-primary mr-2" value="">Sim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </form>