@extends('layouts.default')


@section('content')
<div class="thanks-wrapper">
  <p>ご意見いただきありがとうございました</p>
  <button class="to-toppage-btn">トップページへ</button>
</div>

<style>
  .thanks-wrapper{
    display:flex;
    align-items:center;
    flex-direction:column;
    justify-content:center;
    height: 100vh;
  }
  .thanks-wrapper p{
    font-size:20px;
    margin-bottom:50px;
    transform:translateY(-50%);
  }
  .to-toppage-btn{
    display:block;
    background-color:black;
    color:white;
    width:120px;
    height:40px;
    margin-top:20px;
    cursor:pointer;
}
</style>
@endsection