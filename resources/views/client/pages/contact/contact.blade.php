<!-- contact area start -->
<div class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-info">
                    <div id="googleMap"></div>
                    <div class="contact-details">
                        <div class="contact-title">
                            <h3>Liên hệ chúng tôi</h3>
                        </div>
                        <div class="contact-form">
                            <div class="form-title">
                                <h4>Thông tin liên hệ</h4>
                            </div>
                            <div class="form-content">
                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf
                                    <ul>
                                        <li>
                                            <div class="form-box">
                                                <div class="form-name">
                                                    <label>Tên người dùng <em>*</em> </label>
                                                    <input type="text" name="name" required>
                                                    @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-box">
                                                <div class="form-name">
                                                    <label>Email <em>*</em> </label>
                                                    <input type="email" name="email" required>
                                                    @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-box">
                                                <div class="form-name">
                                                    <label>Số điện thoại</label>
                                                    <input type="text" name="phone">
                                                    @if ($errors->has('phone'))
                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-box">
                                                <div class="form-name">
                                                    <label>Tin nhắn <em>*</em> </label>
                                                    <textarea name="message" cols="5" rows="3" required></textarea>
                                                    @if ($errors->has('message'))
                                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="buttons-set">
                                        <!-- <p><em>*</em> Required Fields</p> -->
                                        <button type="submit">Gửi đi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact area end -->
