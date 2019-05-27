<template>
<div class="vue">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Data Master</a>
        </li>
        <li class="breadcrumb-item active">Kategori Produk</li>
    </ol>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
              Data Kategori Produk</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAddKategori" class="btn btn-success" style="float:right"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            <hr>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-condensed" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in kategoris" :key="row.id_kategori_produk">
                                    <td>{{row.nama_kategori_produk}}</td>
                                    <td>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalEditKategori" class="btn btn-info" onclick="getKategori()"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteKategoriProduk()"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <div class="card-footer small text-muted"></div>
    </div>
</div>
</template>
<script>
    export default {
        mounted() {
            this.getDataKategori()
        },
        data() {
            return{
                loginField : {
                    username : '',
                    password : ''
                },
                kategoris : [],
            }
        },
        methods : {
            addPost(){
                // let vm = this
                // console.log(this.loginField)
                // vm.loginField.username = ''
                // vm.loginField.password = ''
            },
            getDataKategori(){
                let vm = this
                axios.get('/kategoriSample')
                .then(res => {
                    vm.kategoris = res.data
                });
            }
        }
    }
</script>