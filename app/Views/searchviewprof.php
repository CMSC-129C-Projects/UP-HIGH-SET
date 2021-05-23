<?= $this->extend('template/pageTemplate');?>

<?= $this->section('content');?>
<head>
<link href="<?=base_url()?>/public/css/custom/searchviewprof.css" rel="stylesheet">
</head>

<section id="special" class="container-fluid">

<div class="heading text-center">
<h1>Professors</h1>
<div class="input-group">
  <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
    />
  <button type="button" class="btn btn-outline-primary">search</button>
</div>

</div>


<div class="card-container">

    <div class="card">
        <img src="<?=base_url();?>/public/images/avatars/rasta.png" alt="">
        <h1> Professor Name</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque eum nam, officia porro dicta molestiae! Veniam, nemo aliquid. Repellat, iste.</p>
        <a href="#"><button>View Subjects</button></a>
    </div>

    <div class="card">
        <img src="<?=base_url();?>/public/images/avatars/rasta.png" alt="">
        <h1> Professor Name</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque eum nam, officia porro dicta molestiae! Veniam, nemo aliquid. Repellat, iste.</p>
        <a href="#"><button>View Subjects</button></a>
    </div>

    <div class="card">
        <img src="<?=base_url();?>/public/images/avatars/rasta.png" alt="">
        <h1> Professor Name</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque eum nam, officia porro dicta molestiae! Veniam, nemo aliquid. Repellat, iste.</p>
        <a href="#"><button>View Subjects</button></a>
    </div>

</div>

</section>


<?= $this->endSection();?>