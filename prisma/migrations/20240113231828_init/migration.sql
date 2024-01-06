-- CreateTable
CREATE TABLE "Post" (
    "id" SERIAL NOT NULL,
    "instagramId" TEXT NOT NULL,
    "url" TEXT NOT NULL,
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT "Post_pkey" PRIMARY KEY ("id")
);

-- CreateIndex
CREATE UNIQUE INDEX "Post_instagramId_key" ON "Post"("instagramId");
