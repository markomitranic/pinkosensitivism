import Image from "next/image";
import Turso from "~/lib/turso/Turso";

export default async function Home() {
  const posts = await Turso.Posts.list(0, 50);

  return (
    <main className="flex min-h-screen flex-col items-center justify-center bg-gradient-to-b from-[#2e026d] to-[#15162c] text-white">
      <ul className="flex max-w-3xl flex-wrap gap-5">
        {posts.map((post) => (
          <li className="w-1/3" key={post.id}>
            <Image
              src={post.url}
              alt={post.inserted_at}
              width={400}
              height={400}
            />
          </li>
        ))}
      </ul>
    </main>
  );
}
