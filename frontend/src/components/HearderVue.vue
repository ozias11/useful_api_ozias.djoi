<script setup lang="ts">
import { RouterLink } from 'vue-router';

</script>

<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary  border-bottom border-body">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    
                    <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">My Space</a>
                    </li>
                </ul>
            
            </div>
            <div class="d-flex" >
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <RouterLink to="/login" class="btn btn-outline-primary" style="margin-left: 5px;" >Login</RouterLink>
                <RouterLink to="/register" class="btn btn-outline-primary" style="margin-left: 5px;" >Register</RouterLink>
            </div>
            
        </div>
    </nav>
</template>