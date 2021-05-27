// script for home
module.exports = function (data) {
    var _data = {
        post: {
            title: '',
            text: ''
        },
        posts: []
    };
    return {
        data: (() => Object.assign({}, data, _data)),
        mounted() {
            this.init();            
        },
        methods: {
            init() {
                var vm = this;
                $(document).ready(function() {
                    vm.getPosts();
                });
            },

            createPost() {
                var vm = this;
                axios({
                    method: 'POST',
                    url: '/ajax/posts',
                    data: {
                        user_id: vm.user.id,
                        title: vm.post.title,
                        text: vm.post.text
                    }
                })
                .then(function (response) {
                    if (response.status === 201) {
                        var post = response.data.data;
                        vm.posts.unshift(post);
                        vm.post.title = '';
                        vm.post.text = '';
                    }
                });
            },

            deletePost(index) {
                var vm = this;
                axios({
                    method: 'POST',
                    url: '/ajax/posts/'+vm.posts[index].id,
                    data: {
                        _method: 'DELETE'
                    }
                })
                .then(function (response) {
                    if (response.status === 200) {
                        vm.posts.splice(index, 1);
                    }
                });
            },

            getPosts() {
                var vm = this;
                axios({
                    method: 'GET',
                    url: '/ajax/posts',
                })
                .then(function (response) {
                    var posts = response.data.data;
                    posts.forEach((post, index) => {
                        posts[index].editing = false;
                    });
                    vm.posts = posts;
                    vm.posts.forEach((post, index) => {
                        vm.getComments(post.id, index);
                    });
                });
            },

            editPost(index) {
                var vm = this;
                var post = vm.posts[index];
                var title = document.getElementById('post-title-'+post.id).value;
                var text = document.getElementById('post-text-'+post.id).value;
                axios({
                    method: 'POST',
                    url: '/ajax/posts/'+post.id,
                    data: {
                        _method: 'PATCH',
                        title,
                        text
                    }
                })
                .then(function (response) {
                    if (response.status === 200) {
                        post.title = title;
                        post.text = text;
                        vm.togglePostEdit(index);
                    }
                });
            },

            togglePostEdit(postIndex) {
                var vm = this;
                vm.posts[postIndex].editing = !vm.posts[postIndex].editing;
            },

            getComments(postId, index) {
                var vm = this;
                axios({
                    method: 'GET',
                    url: '/ajax/posts/'+postId+'/comments',
                })
                .then(function (response) {
                    var comments = response.data.data;
                    comments.forEach((comment, index) => {
                        comments[index].editing = false;
                    });
                    vm.$set(vm.posts[index], 'comments', comments);
                });
            },

            addComment(event, index) {
                var vm = this;
                axios({
                    method: 'POST',
                    url: '/ajax/posts/'+vm.posts[index].id+'/comments',
                    data: {
                        user_id: vm.user.id,
                        text: event.target.value
                    }
                })
                .then(function (response) {
                    if (response.status === 201) {
                        var comment = response.data.data;
                        vm.posts[index].comments.push(comment);
                    }
                    event.target.value = '';
                });
            },

            editComment(index, commentIndex) {
                var vm = this;
                var post = vm.posts[index];
                var comment = post.comments[commentIndex];
                var text = document.getElementById('comment-text-'+comment.id).value;
                axios({
                    method: 'POST',
                    url: '/ajax/posts/'+post.id+'/comments/'+comment.id,
                    data: {
                        _method: 'PATCH',
                        text
                    }
                })
                .then(function (response) {
                    if (response.status === 200) {
                        comment.text = text;
                        vm.toggleCommentEdit(index, commentIndex)
                    }
                });
            },

            deleteComment(index, id, commentIndex) {
                var vm = this;
                axios({
                    method: 'POST',
                    url: '/ajax/posts/'+vm.posts[index].id+'/comments/'+id,
                    data: {
                        _method: 'DELETE'
                    }
                })
                .then(function (response) {
                    if (response.status === 200) {
                        vm.posts[index].comments.splice(commentIndex, 1);
                    }
                });
            },

            toggleCommentEdit(postIndex, commentIndex) {
                var vm = this;
                vm.posts[postIndex].comments[commentIndex].editing = !vm.posts[postIndex].comments[commentIndex].editing;
            },

            getImage(item) {
                if (item && item.user && item.user.profile && item.user.profile.image)
                    return item.user.profile.image
                else
                    return '';
            }
        }
    }
}
