@extends('layout', ['page' => 'profile', 'data' => ['current' => $user]])

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Profile</h3>
                        @if (auth('web')->user()->id === $user->id)
                            <div class="actions">
                                <span :class="EditClass" v-on:click="toggleEdit()">
                                    <template v-if="editing">
                                        Cancel
                                    </template>
                                    <template v-if="!editing">
                                        Edit
                                    </template>
                                </span>
                                <button class="btn btn-danger btn-sm" v-if="editing" v-on:click=updateProfile()>Save</button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <img src="{{ asset('storage/images/'.(!empty($user->profile) && !empty($user->profile->image) ? $user->profile->image : '')) }}" class="img-fluid display-picture" alt="Responsive image">

                    @if (auth('web')->user()->id === $user->id)
                        <form action="{{ route('profile.image_upload', auth('web')->user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control">
                                </div>
                    
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                    
                            </div>
                        </form>
                    @endif

                    <div class="form-group">
                        <label>Name</label>
                        <br>
                        <template v-if="!editing">
                            @{{ input.name }}
                        </template>
                        <template v-if="editing">
                            <input id="name" type="text" class="form-control" placeholder="Name" v-model="input.name" />
                        </template>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <br>
                        <template v-if="!editing">
                            @{{ input.email }}
                        </template>
                        <template v-if="editing">
                            <input id="email" type="email" class="form-control" placeholder="Email" v-model="input.email" />
                        </template>
                    </div>

                    <template v-if="editing">
                        <div class="form-group">
                            <label>Password</label>
                            <br>
                            <input id="email" type="password" class="form-control" placeholder="Password" v-model="input.password" />
                        </div>

                        <div class="form-group">
                            <label>Confirm password</label>
                            <br>
                            <input id="email" type="password" class="form-control" placeholder="Confirm password" v-model="input.password_confirmation" />
                        </div>
                    </template>

                    <div class="form-group">
                        <label>Phone number</label>
                        <br>
                        <template v-if="!editing">
                            @{{ input.profile.phone_number }}
                        </template>
                        <template v-if="editing">
                            <input id="phone_number" type="text" class="form-control" placeholder="Phone number" v-model="input.profile.phone_number" />
                        </template>
                    </div>

                    <div class="form-group">
                        <label>Mobile number</label>
                        <br>
                        <template v-if="!editing">
                            @{{ input.profile.mobile_number }}
                        </template>
                        <template v-if="editing">
                            <input id="mobile_number" type="text" class="form-control" placeholder="Mobile number" v-model="input.profile.mobile_number" />
                        </template>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <br>
                        <template v-if="!editing">
                            @{{ input.profile.address }}
                        </template>
                        <template v-if="editing">
                            <input id="address" type="text" class="form-control" placeholder="Address" v-model="input.profile.address" />
                        </template>
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <br>
                        <template v-if="!editing">
                            @{{ input.profile.city }}
                        </template>
                        <template v-if="editing">
                            <input id="city" type="text" class="form-control" placeholder="City" v-model="input.profile.city" />
                        </template>
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <br>
                        <template v-if="!editing">
                            @{{ input.profile.state }}
                        </template>
                        <template v-if="editing">
                            <input id="state" type="text" class="form-control" placeholder="State" v-model="input.profile.state" />
                        </template>
                    </div>

                    <div class="form-group">
                        <label>Zip</label>
                        <br>
                        <template v-if="!editing">
                            @{{ input.profile.zip }}
                        </template>
                        <template v-if="editing">
                            <input id="zip" type="text" class="form-control" placeholder="Zip" v-model="input.profile.zip" />
                        </template>
                    </div>
        
                    <div class="card-footer align-items-center">
                        <div>
                            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection