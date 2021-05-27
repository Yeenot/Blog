@extends('layout', ['page' => 'home', 'data' => []])

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-12">
                <input type="text" class="form-control mb-2" placeholder="Title..." v-model="post.title">
                <textarea class="form-control mb-2" rows="5" placeholder="Write a post here..." v-model="post.text"></textarea>
                <button class="btn btn-primary float-right" v-on:click="createPost()">Write</button>
            </div>
        </div>
        <div class="row">
            <h4>Blogs</h4>
            <div class="col-12 card blog mb-4" v-for="(post, postIndex) in posts" :key="post.id">
                <div class="card-body">
                    <div class="actions" v-if="user.id === post.user.id">
                        <span class="text-info" v-on:click="togglePostEdit(postIndex)">Edit</span>
                        <span class="text-danger" v-on:click="deletePost(postIndex)">Delete</span>
                    </div>
                    <div class="details">
                    <img class="avatar" :src="'/storage/images/'+getImage(post)" alt="">
                        <span class="datetime">@{{ moment(post.created_at).format('YYYY/MM/DD h:mm a') }}</span>
                        <label><a :href="'/profile/'+post.user.id">@{{ post.user.name }}</a></label><br/>
                        <template v-if="post.editing">
                            <input :id="'post-title-'+post.id" type="text" class="form-control" placeholder="Title..." :value="post.title" v-on:keyup.esc="togglePostEdit(postIndex)"
                                v-on:keyup.enter="event => editPost(postIndex)"/>
                            <textarea :id="'post-text-'+post.id" rows="5" class="form-control" placeholder="Title..." :value="post.text" v-on:keyup.esc="togglePostEdit(postIndex)"></textarea>
                            <button class="btn btn-info btn-sm" v-on:click="event => editPost(postIndex)">Update</button>
                            <button class="btn btn-danger btn-sm" v-on:click="event => togglePostEdit(postIndex)">Cancel</button>
                        </template>
                        <template v-if="!post.editing">
                            <h4 class="card-title">@{{ post.title }}</h4>
                            <p class="card-text">@{{ post.text }}</p>
                        </template>
                    </div>
                    <div class="comments">
                        <div class="title">COMMENTS</div>
                        <div class="wrapper">
                            <div class="comment" v-for="(comment, commentIndex) in post.comments" :key="comment.id">
                                <div class="actions" v-if="user.id === comment.user.id">
                                    <span class="text-info" v-on:click="toggleCommentEdit(postIndex, commentIndex)">Edit</span>
                                    <span class="text-danger" v-on:click="deleteComment(postIndex, comment.id, commentIndex)">Delete</span>
                                </div>
                                <div class="details">
                                    <img class="avatar" :src="'/storage/images/'+getImage(comment)" alt="">
                                    <span class="datetime">@{{ moment(comment.updated_at).format('YYYY/MM/DD h:mm a') }}</span>
                                    <label><a :href="'/profile/'+comment.user.id">@{{ comment.user.name }}</a></label><br/>
                                    <template v-if="comment.editing">
                                        <input :id="'comment-text-'+comment.id" type="text" class="form-control" placeholder="Write a comment here..." :value="comment.text" v-on:keyup.esc="toggleCommentEdit(postIndex, commentIndex)"
                                            v-on:keyup.enter="event => editComment(postIndex, commentIndex)"/>
                                        <button class="btn btn-info btn-sm" v-on:click="event => editComment(postIndex, commentIndex)">Update</button>
                                        <button class="btn btn-danger btn-sm" v-on:click="event => toggleCommentEdit(postIndex, commentIndex)">Cancel</button>
                                    </template>
                                    <template v-if="!comment.editing">
                                        @{{ comment.text }}
                                    </template>
                                </div>
                            </div>
                            <input :id="'post-comment-' + post.id" class="form-control mt-2" v-on:keyup.enter="event => addComment(event, postIndex)" type="text" placeholder="Place a comment here...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection