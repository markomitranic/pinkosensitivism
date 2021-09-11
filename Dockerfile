FROM elixir:latest

WORKDIR /app/src
RUN mix local.hex --force && \
    mix local.rebar --force

# HEALTHCHECK --interval=30s \
#     --timeout=10s \
#     --start-period=15s \
#     --retries=3 \
#     CMD ["CMD", "curl", "http://127.0.0.1:80"]