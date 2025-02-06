  {{-- sidebar menu start --}}
  <ul id="sidebar_menu">
      <li class="mm-active">
          <a class="has-arrow" href="#" aria-expanded="false">
              <div class="icon_menu">
                  <img src="{{asset('img/menu-icon/dashboard.svg')}}" alt="">
              </div>
              <span>Trang Chủ</span>
          </a>
          <ul>
              <li><a class="active" href="{{url('/admin')}}">Sales Mode</a></li>
              <li><a href="{{url('/admin')}}">Default Mode</a></li>

          </ul>
      </li>
      <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">
              <div class="icon_menu">
                  <img src="{{asset('img/menu-icon/2.svg')}}" alt="">
              </div>
              <span>Danh mục</span>
          </a>
          <ul>
              <li><a href="{{url('/admin/categories')}}">Danh sách</a></li>
              <li><a href="{{url('/admin/categories/create')}}">Thêm mới </a></li>
          </ul>
      </li>
      <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">

              <div class="icon_menu">
                  <img src="{{asset('img/menu-icon/4.svg')}}" alt="">
              </div>
              <span>Sản phẩm</span>
          </a>
          <ul>
              <li><a href="{{url('/admin/products')}}">Danh sách</a></li>
              <li><a href="{{url('/admin/products/create')}}">Thêm mới</a></li>

          </ul>
      </li>
      <li class="">
          <a class="has-arrow" href="#" aria-expanded="false">

              <div class="icon_menu">
                  <img src="{{asset('img/menu-icon/5.svg')}}" alt="">
              </div>
              <span>Người dùng</span>
          </a>
          <ul>
              <li><a href="{{url('/admin/users')}}">Danh sách</a></li>
              <li><a href="{{url('/admin/users/create')}}">Thêm mới</a></li>
          </ul>
      </li>

  </ul>
  </nav>
  {{-- sidebar menu end --}}
