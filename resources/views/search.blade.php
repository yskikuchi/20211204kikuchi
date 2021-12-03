@extends('layouts.default')

@section('title','管理システム')
@section('content')

<form action="/search" method="GET">
  <div class="search-wrapper">
    <div class="line1">
      <label class="search-ttl" for="name">お名前</label>
      <input class="search-name" type="text" name="name" id="name" value="{{ $searchData['name'] ?? '' }}">
      <label class="search-ttl" >性別</label>
      <label for="all">
        <input class="search-gender" type="radio" name="gender" id="all" value=0 @if(empty($searchData)) checked @elseif ($searchData['gender'] == 0) checked @else '' @endif>
        全て
      </label>
      <label for="male">
        <input class="search-gender" type="radio" name="gender" id="male" value=1 @if(empty($searchData)) '' @elseif ($searchData['gender'] == 1)  checked @else '' @endif>
        男性
      </label>
      <label for="female">
        <input class="search-gender" type="radio" name="gender" id="female" value=2 @if(empty($searchData)) '' @elseif($searchData['gender'] == 2) checked @else '' @endif>
        女性
      </label>
    </div>
    <div class="line2">
      <label class="search-ttl" for="date">
        日付
      </label>
      <input class="search-date" type="date" id="date" name="fromDate" value="{{ $searchData['fromDate'] ?? '' }}"> 
      〜
      <input class="search-date" type="date" name="toDate" value="{{ $searchData['toDate'] ?? '' }}">
    </div>
    <div class="line3">
      <label class="search-ttl" for="email">
        メールアドレス
      </label>
      <input class="search-email" type="text" name="email" value="{{ $searchData['email'] ?? '' }}">
    </div>
    <button class="search-btn">検索</button>
    <a class="reset-btn" href="/search">リセット</a>
  </div>
</form>
  <div>

    全{{$options->total()}}件中
    {{($options->currentPage()-1) * $options->perPage() + 1}}
    ~
    @if($options->currentPage() == $options->lastPage())
    {{$options->total()}}件
    @else
    {{(($options->currentPage()-1) * $options->perPage()+1) + 9}}件
    @endif
    {{$options->links('pagination::bootstrap-4')}}
    <table>
        <tr class="result-ttl">
          <th>ID</th>
          <th>お名前</th>
          <th>性別</th>
          <th>メールアドレス</th>
          <th>ご意見</th>
        </tr>
      @foreach($options->all() as $option)
      <form action="/search" method="POST">
      @csrf
        <tr>
          <td>{{$option->id}}</td>
          <td>{{$option->fullname}}</td>
          <td>{{($option->gender)==1 ? '男性':'女性';}}</td>
          <td>{{$option->email}}</td>
          <td>
            <p class="opinion-text">{{$option->opinion}}</p>
            <p class="opinion-hidden"><{{$option->opinion}}/p>
          </td>
          <td>
            <input type="hidden" name="id" value={{ $option->id }}>
            <button class="delete-btn">削除</button>
          </td>
        </tr>
      </form>
      @endforeach
    </table>
  </div>

<script>
  const opinions = document.getElementsByClassName("opinion-text");

  const arrayOpinions = Array.from(opinions);
  arrayOpinions.forEach(e => {
    if(e.textContent.length >= 25){
      e.setAttribute("original",e.textContent);
      return e.textContent = e.textContent.substr(0,25)+"...";
      }else{
        return e.textContent;
      }
  });
  console.log(arrayOpinions);
  arrayOpinions.forEach(e => {
    e.addEventListener("mouseover", () =>{
    return e.textContent = e.getAttribute("original");
    });
    e.addEventListener("mouseout", () =>{
    return e.textContent = e.textContent.substr(0,25)+"...";
    });
  })


</script>

@endsection

<style>
  .pagination{
    display:flex;
    justify-content:flex-end;
  }
  .page-item{
    border:1px solid black;
    padding:5px;
    list-style:none;
  }
  .search-wrapper{
    border:1px solid black;
    text-align:left;
  }
  .search-ttl{
    display:inline-block;
    line-height:2em;
    margin:0 30px 0 30px;
    font-weight:bold;
  }
  .search-name, .search-date, .search-email{
    height:50px;
    width:300px;
    border:1px solid black;
    border-radius:5px;
  }
  .search-gender{
    height:50px;
    transform:scale(2.5);
    margin-right:10px;
    margin-left:20px;
    }

  .line1, .line2, .line3{
    margin:30px;
  }
  .search-btn{
    display:block;
    margin:0 auto;
    background-color:black;
    color:white;
    width:120px;
    height:40px;
    margin-top:20px;
    cursor:pointer;
  }
  .reset-btn{
    display:block;
    text-align:center;
    height:30px;
    margin:10px 0px;
  }
  .result-ttl{
    border-bottom:2px solid black;
  }
  .result-ttl th{
    width:10%;
  }
  .result-ttl th:nth-of-type(5){
    width:35%;
  }
  td{
    text-align:center;
  }
  .delete-btn{
    background-color:black;
    color:white;
    height:30px;
    margin-top:20px;
    padding:0 20px;
    cursor:pointer;
  }

.opinion-hidden{
  display:none;
}
</style>

