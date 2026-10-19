@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h5 class="fw-bold mb-1">Dashboard</h5>
                <p class="text-muted mb-0">Welcome Back, {{ auth()->user()->name }} 👋</p>
            </div>

            <button class="btn btn-primary px-4">
                <i class="fa-solid fa-plus me-2"></i>
                New Service
            </button>

        </div>

        <!-- Statistics -->

        <div class="row g-4">
            <div class="col-xl-3 col-lg-6 col-md-6">

                <div class="stat-card">

                    <div class="stat-info">

                        <h6>Total Users</h6>

                        <h2>154</h2>

                        <p class="text-success">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                            +12% this month
                        </p>

                    </div>

                    <div class="stat-icon blue">

                        <i class="fa-solid fa-users"></i>

                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">

                <div class="stat-card">

                    <div class="stat-info">

                        <h6>Categories</h6>

                        <h2>18</h2>

                        <p class="text-warning">

                            <i class="fa-solid fa-layer-group"></i>

                            Total Categories

                        </p>

                    </div>

                    <div class="stat-icon orange">

                        <i class="fa-solid fa-layer-group"></i>

                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">

                <div class="stat-card">

                    <div class="stat-info">

                        <h6>Services</h6>

                        <h2>67</h2>

                        <p class="text-success">

                            Active Services

                        </p>

                    </div>

                    <div class="stat-icon green">

                        <i class="fa-solid fa-briefcase"></i>

                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6">

                <div class="stat-card">

                    <div class="stat-info">

                        <h6>Reviews</h6>

                        <h2>920</h2>

                        <p class="text-danger">

                            Total Reviews

                        </p>

                    </div>

                    <div class="stat-icon red">

                        <i class="fa-solid fa-star"></i>

                    </div>

                </div>
            </div>

        </div>

        <!-- Content -->

        <div class="row g-4">

            <!-- Users -->

            <div class="col-lg-8">

                <div class="dashboard-card">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h4 class="mb-0">

                            Latest Users

                        </h4>

                        <a href="#" class="btn btn-outline-primary btn-sm">

                            View All

                        </a>

                    </div>

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th>User</th>

                                <th>Email</th>

                                <th>Role</th>

                                <th>Status</th>

                                <th></th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <img src="https://ui-avatars.com/api/?name=Hamdy+Reda" class="rounded-circle"
                                            width="45">

                                        <div>

                                            <strong>Hamdy Reda</strong>

                                            <br>

                                            <small class="text-muted">

                                                ID #1

                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    admin@gmail.com

                                </td>

                                <td>

                                    <span class="badge bg-primary">

                                        Admin

                                    </span>

                                </td>

                                <td>

                                    <span class="badge bg-success">

                                        Active

                                    </span>

                                </td>

                                <td>

                                    <button class="btn btn-light">

                                        <i class="fa-solid fa-eye"></i>

                                    </button>

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <img src="https://ui-avatars.com/api/?name=Ahmed+Ali" class="rounded-circle"
                                            width="45">

                                        <div>

                                            <strong>Ahmed Ali</strong>

                                            <br>

                                            <small class="text-muted">

                                                ID #2

                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <td>

                                    ahmed@gmail.com

                                </td>

                                <td>

                                    <span class="badge bg-secondary">

                                        User

                                    </span>

                                </td>

                                <td>

                                    <span class="badge bg-success">

                                        Active

                                    </span>

                                </td>

                                <td>

                                    <button class="btn btn-light">

                                        <i class="fa-solid fa-eye"></i>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Right Side -->

            <div class="col-lg-4">

                <div class="dashboard-card mb-4">

                    <h4 class="mb-4">

                        Quick Actions

                    </h4>

                    <div class="d-grid gap-3">

                        <button class="btn btn-primary">

                            <i class="fa-solid fa-user-plus me-2"></i>

                            Add User

                        </button>

                        <button class="btn btn-success">

                            <i class="fa-solid fa-layer-group me-2"></i>

                            Add Category

                        </button>

                        <button class="btn btn-warning text-white">

                            <i class="fa-solid fa-briefcase me-2"></i>

                            Add Service

                        </button>

                    </div>

                </div>

                <div class="dashboard-card">

                    <h4 class="mb-3">

                        Server Status

                    </h4>

                    <div class="progress mb-3" style="height:10px;">

                        <div class="progress-bar bg-success" style="width:82%"></div>

                    </div>

                    <small class="text-muted">

                        Server running normally (82%)

                    </small>

                </div>

            </div>

        </div>

    </div>

@endsection
