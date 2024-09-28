@extends('front.layouts.master')

<div class="container" style="margin-top: 150px">
    <form class="login-form" method="POST" action="{{ route('supmitlogin') }}">
        @csrf
        <div class="mb-3 d-flex flex-column">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>
        <div class="mb-3 d-flex flex-column">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>
    </form>
</div>

<style>
    .login-form {
        max-width: 500px;
        height: 50vh;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        margin-top: 50px;

    }
</style>
