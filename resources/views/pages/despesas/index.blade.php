@extends('template')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/lib/dataTables/datatables.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/lib/flatpickr/flatpickr.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/lib/flatpickr/dark.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row row-cards mb-4">
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <i class="ti ti-currency-dollar icon"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Entradas
                                    </div>
                                    <div class="text-secondary entries-value">
                                        Carregando...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-red text-white avatar">
                                        <i class="ti ti-currency-euro icon"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Saídas
                                    </div>
                                    <div class="text-secondary exits-value">
                                        Carregando...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar">
                                        <i class="ti ti-currency-real icon"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        Saldo
                                    </div>
                                    <div class="text-secondary balance-value">
                                        Carregando...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Despesas <span id="text-period"></span>
                    </div>
                    <h2 class="page-title">
                        Entradas e Saídas
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <a href="#expenseFilter" class="btn bg-orange text-orange-fg d-none d-sm-inline-block"
                        data-bs-toggle="offcanvas" aria-label="Filtrar despesas">
                        Filtrar
                    </a>
                    <a href="#expenseFilter" class="btn btn-orange d-sm-none btn-icon" data-bs-toggle="offcanvas"
                        aria-label="Filtrar despesas">
                        <i class="ti icon ti-filter"></i>
                    </a>
                    <a href="#" class="btn bg-blue text-blue-fg d-none d-sm-inline-block" data-bs-toggle="modal"
                        data-bs-target="#modal-add-expense" aria-label="Nova despesa">
                        Nova despesa
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-add-expense" aria-label="Nova despesa">
                        <i class="ti icon ti-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="table-responsive">
                    <table id="expensesTable" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Despesa</th>
                                <th>Informação</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th width="160px">Ações</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="expenseFilter" aria-labelledby="expenseFilterLabel">
        <div class="offcanvas-body">
            <div class="text-end">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                    role="button"></button>
            </div>
            <div>
                <div class="row mb-3">
                    <div class="font-weight-medium">
                        Período
                    </div>
                    <input type="text" name="period" id="period-expense" class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-secondary" type="button" id="clean-filter">
                        Limpar
                    </button>
                    <button class="btn btn-primary" type="button" id="confirm-filter">
                        Filtrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($expenses as $expense)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="expenseDetail{{ $expense->CODDESPESA }}"
            aria-labelledby="expenseDetailLabel">
            <div class="offcanvas-body">
                <div class="text-end">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"
                        role="button"></button>
                </div>
                <div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="font-weight-medium">
                                Despesa
                            </div>
                            <div class="text-secondary">
                                {{ $expense->DESPESA }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="font-weight-medium">
                                Informações
                            </div>
                            <div class="text-secondary">
                                {{ $expense->DESCRICAO }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="font-weight-medium">
                                Tipo
                            </div>
                            <div class="text-secondary">
                                <span
                                    class="badge bg-{{ $expense->TIPO == 'ENTRADA' ? 'green' : 'red' }}-lt">{{ $expense->TIPO }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="font-weight-medium">
                                Valor
                            </div>
                            <div class="text-secondary">
                                R$ {{ number_format($expense->VALOR, 2, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="font-weight-medium">
                                Data
                            </div>
                            <div class="text-secondary">
                                {{ \Carbon\Carbon::parse($expense->DATA)->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="offcanvas">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    <x-form-add-expense />
    <x-form-edit-expense />
@endsection

@section('script')
    <script src="{{ asset('assets/lib/jquery/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/lib/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/lib/flatpickr/flatpickr.js') }}"></script>
    <script>
        function writeValueModal(cod) {
            let expenseId = cod;

            if (!expenseId) {
                return;
            }

            $.ajax({
                url: `${BASEURL}/despesas/getExpenseByCod`,
                method: "GET",
                data: {
                    CODDESPESA: expenseId,
                },
                success: function(response) {
                    if (!response.success) {
                        return;
                    }

                    $('#modal-edit-expense input[name="CODDESPESA"]').val(response.expense
                        .CODDESPESA);
                    $('#modal-edit-expense input[name="DESPESA"]').val(response.expense
                        .DESPESA);
                    $('#modal-edit-expense textarea[name="DESCRICAO"]').val(response.expense
                        .DESCRICAO);
                    $('#modal-edit-expense input[name="VALOR"]').val(response.expense
                        .VALOR);

                    $('#modal-edit-expense input[name="TIPO"][value="' + response.expense
                            .TIPO + '"]')
                        .prop('checked',
                            true);

                    // Formatação de data, caso seja necessário
                    let formattedDate = new Date(response.expense.DATA).toISOString().split(
                        'T')[0];
                    $('#modal-edit-expense input[name="DATA"]').val(formattedDate);
                }
            });
        }

        function valueNumeric(form) {
            var value = $(form).find('.expense-value').val();
            var numericValue = value.replace(/[^\d,.-]/g, '').replace(',', '.');
            $(form).find('.expense-value').val(numericValue);
        }

        function writeValues() {
            let date = $('#period-expense').val();

            let start_date = null;
            let end_date = null;

            if (date) {
                let dateRange = date.split('to');

                if (dateRange.length === 2) {
                    start_date = dateRange[0].trim();
                    end_date = dateRange[1].trim();
                } else if (dateRange.length === 1) {
                    start_date = dateRange[0].trim();
                }
            }

            $.ajax({
                url: `${BASEURL}/despesas/getValues`,
                method: "GET",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                success: function(response) {
                    $('.entries-value').text(
                        `R$ ${parseFloat(response.values.entries || 0).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
                    );

                    $('.exits-value').text(
                        `R$ ${parseFloat(response.values.exits || 0).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
                    );

                    $('.balance-value').text(
                        `R$ ${parseFloat(response.values.balance || 0).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
                    );
                }
            });
        }

        writeValues();

        $.extend($.fn.dataTable.defaults, {
            searching: true,
            ordering: true
        });

        $("#period-expense").flatpickr({
            mode: "range",
            dateFormat: "d-m-Y",
        });

        function formatDate(date) {
            if (date) {
                const parsedDate = new Date(date + 'T00:00:00');
                return parsedDate.toLocaleDateString('pt-BR');
            }
            return '';
        }

        $(document).ready(function() {

            let table = new DataTable('#expensesTable', {
                processing: true,
                serverSide: true,
                ajax: {
                    url: `${BASEURL}/despesas/createDataTable`,
                    type: 'GET',
                    data: function(d) {
                        let date = $('#period-expense').val();

                        if (date) {
                            let dateRange = date.split('to');

                            if (dateRange.length === 2) {
                                let startDate = dateRange[0].trim();
                                let endDate = dateRange[1].trim();

                                d.start_date = startDate;
                                d.end_date = endDate;
                            } else if (dateRange.length === 1) {
                                let startDate = dateRange[0].trim();

                                d.start_date = startDate;
                                d.end_date = null;
                            }
                        }
                    },
                    dataSrc: 'data'
                },
                columns: [{
                        data: 'DESPESA',
                        render: function(data) {
                            return data;
                        }
                    },
                    {
                        data: 'DESCRICAO',
                        render: function(data) {
                            let desc = data;
                            if (!desc) {
                                return '-';
                            }
                            return data.length > 40 ? data.substring(0, 40) + '...' : data;
                        }
                    },
                    {
                        data: 'TIPO',
                        render: function(data) {
                            return `<span class="badge bg-${data === 'ENTRADA' ? 'green' : 'red'}-lt">${data}</span>`;
                        }
                    },
                    {
                        data: 'VALOR',
                        render: function(data) {
                            return `<strong>R$ ${parseFloat(data).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</strong>`;
                        }
                    },
                    {
                        data: 'DATA',
                        render: function(data) {
                            return formatDate(data);
                        }
                    },
                    {
                        data: 'CODDESPESA',
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-outline-primary btn-icon button-edit-expense"
                                    onclick="writeValueModal('${data}')" data-bs-toggle="modal"
                                    data-bs-target="#modal-edit-expense"
                                    aria-label="Editar despensa ${row.DESPESA}">
                                    <i class="ti icon ti-edit"></i>
                                </button>
                                <a href="${BASEURL}/despesas/${data}"
                                    class="btn btn-outline-red btn-icon" data-confirm-delete="true">
                                    <i class="ti icon ti-trash"></i>
                                </a>
                                <a class="btn btn-outline-azure btn-icon" data-bs-toggle="offcanvas"
                                    href="#expenseDetail${data}">
                                    <i class="ti icon ti-eye"></i>
                                </a>
                                `;
                        }
                    }
                ],
                order: [],
                language: {
                    sProcessing: "Processando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "Nenhum registro encontrado",
                    sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando 0 registros",
                    sInfoFiltered: "(filtrado de _MAX_ registros no total)",
                    sSearch: "Pesquisar:",
                    oAria: {
                        sSortAscending: ": Ordenar colunas de forma ascendente",
                        sSortDescending: ": Ordenar colunas de forma descendente"
                    }
                }
            });

            function writeTextPeriod() {
                let date = $('#period-expense').val();
                let periodText = "";

                if (date) {
                    let dateRange = date.split('to');

                    if (dateRange.length === 2) {
                        let startDate = dateRange[0].trim();
                        let endDate = dateRange[1].trim();

                        startDate = startDate.replace('-', '/');
                        endDate = endDate.replace('-', '/');

                        periodText = `(${startDate} até ${endDate})`;
                    } else if (dateRange.length === 1) {
                        let startDate = dateRange[0].trim();
                        startDate = startDate.replace('-', '/');
                        periodText = `(${startDate})`;
                    }
                }


                $('#text-period').text(periodText);
            }

            $("#confirm-filter").on('click', function() {
                writeValues();
                writeTextPeriod();
                table.ajax.reload();
            });

            $("#clean-filter").on('click', function() {
                $("#period-expense").val('');
                writeValues();
                writeTextPeriod();
                table.ajax.reload();
            });

            $('.expense-value').mask('000.000.000.000.000,00', {
                reverse: true
            });

            $('#expense-add-form').submit(function(event) {
                valueNumeric($(this));
            });

            $('#expense-edit-form').submit(function(event) {
                valueNumeric($(this));

                let cod = $('#modal-edit-expense input[name="CODDESPESA"]').val();

                $(this).attr('action', `${BASEURL}/despesas/${cod}`);

                // event.preventDefault();
                // let data = $(this).serialize();
                // $.ajax({
                //     url: `${BASEURL}/despesas/${cod}`,
                //     method: 'PUT',
                //     data: data,
                //     success: function() {
                //         alert('Atualizou');
                //     },
                //     error: function(xhr, status, error) {
                //         console.log('Error:', error);
                //     }
                // });
            });

            $(document).on('click', '[data-confirm-delete="true"]', function() {
                let $btn = $(this);
                let $row = $btn.closest('tr');
                let codDespesa = $row.find('button.button-edit-expense').attr('onclick').match(/'(\d+)'/)[
                1];

                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Essa ação não poderá ser desfeita!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `${BASEURL}/despesas/${codDespesa}`,
                            type: 'DELETE',
                            success: function(response) {
                                $('#expensesTable').DataTable().ajax.reload(null,
                                false);
                                Swal.fire('Excluído!',
                                    'A despesa foi excluída com sucesso.', 'success'
                                    );
                            },
                            error: function(xhr) {
                                Swal.fire('Erro', 'Erro ao excluir a despesa.',
                                'error');
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection
