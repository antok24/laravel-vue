<template>
  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header card-primary">Posts</div>
          <div class="card-body">
          <router-link :to="{ name: 'create'}" class="btn btn-md btn-primary">Add Data</router-link>
          <div class="table-responsive mt-2">
          <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Konten</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="(post, index) in posts" :key="post.id">
                <td>{{post.title}}</td>
                <td>{{post.content}}</td>
                <td class="text-center">
                    <router-link :to="{name: 'edit', params: {id: post.id }}" class="btn btn-sm btn-warning">Edit</router-link>
                    <button @click.prevent="PostDelete(post.id, index)" class="btn btn-sm btn-danger">Hapus</button>
                </td>
            </tr>
            </tbody>
          </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            posts: []
        }
    },
    created() {
        let uri = 'http://localhost:8000/api/posts';
        this.axios.get(uri).then(response => {
            this.posts = response.data.data;
        });
    }
}
</script>