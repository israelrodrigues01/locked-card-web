setInterval(async () => {
    try {
        const response = await fetch('http://192.168.100.147:8000/registro/getRegister');
        const data = await response.json();

        const hasEntrada = data?.ENTRADA !== null;
        const hasSaida = data?.SAIDA !== null;

        const door = document.querySelector('.door');
        const content = document.querySelector('.content');

        // Admin: se tiver entrada mas não saída, ativa a porta
        if (hasEntrada && !hasSaida) {
            door.classList.add('active');
            door.classList.remove('danger');
            content.classList.add('active');
            content.classList.remove('danger');
        } else {
            door.classList.remove('active');
            content.classList.remove('active');
        }

    } catch (error) {
        console.error('Erro ao buscar registro:', error);
        document.querySelector('.door')?.classList.remove('active');
    }
}, 3000); // Aumentamos o intervalo para 3 segundos

setInterval(async () => {
    try {
        const response = await fetch('http://192.168.100.147:8000/registro/getRegisterNotUserPermission');
        const data = await response.json();

        const door = document.querySelector('.door');
        const content = document.querySelector('.content');

        // Verifica se é o usuário clay, caso seja, aplica a classe danger e alerta por 3s
        if (data && Object.keys(data).length > 0) {
            door.classList.add('danger');
            content.classList.add('danger');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log(data)

            // Envia requisição DELETE para o servidor para deletar o registro
            const deleteResponse = await fetch(`http://192.168.100.147:8000/registros/${data.CODREGIS}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            if (deleteResponse.ok) {
                console.log('Registro excluído com sucesso!');
            } else {
                console.error('Erro ao excluir o registro!');
            }
        }else{
            door.classList.remove('danger');
            content.classList.remove('danger');
        }

    } catch (error) {
        const door = document.querySelector('.door');
        const content = document.querySelector('.content');

        // Remover classe danger caso ocorra erro na requisição
        door?.classList.remove('danger');
        content?.classList.remove('danger');
        isDangerShown = false; // Reinicia o controle de alerta caso haja erro
    }
}, 3000); // Aumentamos o intervalo para 3 segundos
