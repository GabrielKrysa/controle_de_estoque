<template>
    <div>
        <div class=" container row">
            <input class="form-control col-6 mr-3 ml-4" placeholder="Digite seu nome" v-model="nome">
            <input class="form-control col-4" placeholder="Digite seu telefone" v-model="telefone">
        </div>
        <h1 class="col-12">{{ cidade }}</h1>
        <div class="row" style="margin-left: 25px; margin-right: 25px;">
            <div class="col" v-for="(produto, index) in produtos">
                <div class="card">
                    <img class="img-responsive" :src="`/uploads/${produto.image_name}`" alt="Image"
                         style="width:100%">
                    <h1> {{ produto.nome }} </h1>
                    <p class="price">R$ {{ produto.preco }}</p>
                    <p>
                        {{ produto.descricao }}
                    </p>
                    <p>
                        Quantidade disponível: {{ produto.quantidade }}
                    </p>

                    <div class="mb-2">
                        <a class="btn btn-success mr-3" style="cursor: pointer"
                           @click="subQuantidade(produto, index)">-</a>
                        <span>{{ produtos[index].quatidadePedido }}</span>
                        <a class="btn btn-success ml-3"
                           style="cursor: pointer"
                           @click="addQuantidade(produto, index)">+</a>

                    </div>

                    <button v-if="produto.pedidoFeito === false" @click="addCarrinho(produto, index)">
                        Realizar pedido
                    </button>
                    <button style="background-color: #2a9055" v-else>
                        Pedido Realizado!
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['produtosList', 'cidade'],

    name: "produtos-component",

    data() {
        return {
            nome: '',
            telefone: '',
            produtos: []
        }
    },

    methods: {
        addQuantidade(produto, index) {
            if (produto.quantidade > produto.quatidadePedido) {
                if (produto.pedidoFeito === false) {
                    this.produtos[index].quatidadePedido++;
                }
            }
        },

        subQuantidade(produto, index) {
            if (produto.quatidadePedido >= 1) {
                if (produto.pedidoFeito === false) {
                    this.produtos[index].quatidadePedido--;
                }
            }
        },

        addCarrinho(produto, index) {
            if (this.produtos[index].quatidadePedido === 0) {
                this.$swal('A quantidade do pedido precisa ser maior do que 0')
                return;
            }

            if (!this.telefone || !this.nome) {
                this.$swal('Nome e telefone obrigatórios para adicionar itens ao carrinho')
                return;
            }

            axios.post('/pedido', {
                produto_id: produto.id,
                quantidade: produto.quatidadePedido,
                telefone: this.telefone,
                nome: this.nome,
                valor: produto.preco * produto.quatidadePedido,
            }).then(() => {
                this.produtos[index].pedidoFeito = true;
                this.$swal('Pedido realizado com sucesso!');
            });
        }
    },

    created() {
        for (let i = 0; i < this.produtosList.length; i++) {
            this.produtosList[i].quatidadePedido = 0;
            this.produtosList[i].pedidoFeito = false;
            this.produtos.push(this.produtosList[i]);
        }
    }

}
</script>

<style scoped>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 300px;
    margin: auto;
    text-align: center;
    font-family: arial;
}

.price {
    color: grey;
    font-size: 22px;
}

.card button:hover {
    opacity: 0.7;
}

.card button {
    border: none;
    outline: 0;
    padding: 12px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
    bottom: 0 !important;
}

</style>

