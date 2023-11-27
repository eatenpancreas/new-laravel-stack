<script>
    import {onMount} from "svelte";

    let status = "Getting api...";
    
    onMount(async () => {
        const response = await fetch("http://localhost:8000/api/");
        const data = await response.json();
        status = data.status;
    })
</script>

<h1>Status: {status}</h1>