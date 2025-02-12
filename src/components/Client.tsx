import { onMount } from "solid-js";
import { dbg } from "~/lib/utils/dbg";

export default function Client() {
  onMount(() => {
    dbg("Hello!");
  });

  return (
    <div id="container">
      <div id="container1">Hello!</div>
    </div>
  );
}
