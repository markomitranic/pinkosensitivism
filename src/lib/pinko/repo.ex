defmodule Pinko.Repo do
  use Ecto.Repo,
    otp_app: :pinko,
    adapter: Ecto.Adapters.Postgres
end
