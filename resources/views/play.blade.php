<html>

<head>
    <meta charset="utf-8" />
    <script src="/js/wasm_exec.js"></script>
    <script>
        const go = new Go();
  let mod, inst;

  async function fetch_wasm_module() {
    const response = await fetch("/ghost.wasm");
    const buffer = await response.arrayBuffer();
    const obj = await WebAssembly.instantiate(buffer, go.importObject);
    mod = obj.module;
    inst = obj.instance;
    await go.run(inst);
  }
  fetch_wasm_module()

  function run() {
    let code = "print('hello, world!')"
    let {out, result} = run_ghost_code(code)
    document.getElementById("out-area").innerHTML = out || "No output"
    document.getElementById("result-area").innerHTML = result || "No return value"
  }

  run()
    </script>
</head>

<body>
    <h1>Ghost Play</h1>

    <code>print('hello, world!')</code><br><br><br>

    Out:<br>
    <div id="out-area"></div>

    Result:<br>
    <div id="result-area"></div>
</body>

</html>