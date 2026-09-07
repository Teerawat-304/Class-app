<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>สมัครสมาชิกอาจารย์</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>


<body class="bg-light">


<div class="container">


    <div class="row justify-content-center mt-5">


        <div class="col-md-6">


            <div class="card shadow">


                <div class="card-header bg-warning text-center">

                    <h4>

                        สมัครสมาชิกอาจารย์

                    </h4>

                </div>


                <div class="card-body">


                    <form
                        method="POST"
                        action="{{ route('teacher.register') }}"
                    >

                        @csrf


                        <div class="mb-3">

                            <label>

                                รหัสอาจารย์

                            </label>


                            <input
                                type="text"
                                name="teacher_id"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label>

                                ชื่ออาจารย์

                            </label>


                            <input
                                type="text"
                                name="teacher_name"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label>

                                อีเมล

                            </label>


                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label>

                                Username

                            </label>


                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label>

                                รหัสผ่าน

                            </label>


                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label>

                                ยืนยันรหัสผ่าน

                            </label>


                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required
                            >

                        </div>


                        <button
                            class="btn btn-warning w-100"
                        >

                            สมัครสมาชิก

                        </button>


                    </form>


                </div>


            </div>


        </div>


    </div>


</div>


</body>

</html>
