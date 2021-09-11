defmodule PinkoWeb.PageController do
  use PinkoWeb, :controller

  def index(conn, _params) do
    render(conn, "index.html")
  end
end
