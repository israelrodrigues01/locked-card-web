<div class="modal fade" id="modal-edit-expense" tabindex="-1" aria-labelledby="modal-edit-expenseLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <form action="" method="POST" id="expense-edit-form">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="CODDESPESA">

                    <div class="modal-body_content mt-3 mb-3">
                        <div class="mb-3">
                            <label class="form-label required">Despesa</label>
                            <div>
                                <input type="text" name="DESPESA" class="form-control"
                                    placeholder="Qual foi a Despesa?" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Informações</label>
                            <textarea class="form-control" data-bs-toggle="autosize" placeholder="Tem informações adicionais?" name="DESCRICAO"
                                style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 60px;"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Valor da Despesa (R$)</label>
                            <div>
                                <input type="text" name="VALOR" class="form-control expense-value"
                                    placeholder="R$ 0,00" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tipo da despesa?</label>
                            <div class="form-selectgroup">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="TIPO" value="ENTRADA" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label" required>Entrada</span>
                                </label>

                                <label class="form-selectgroup-item">
                                    <input type="radio" name="TIPO" value="SAIDA" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label" required>Saída</span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Data da despesa?</label>
                            <input class="form-control" placeholder="Selecione a data" type="date" name="DATA"
                                required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
