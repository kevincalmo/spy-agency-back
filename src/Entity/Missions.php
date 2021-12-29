<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MissionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Contacts;
use App\Entity\Agents;
use App\Entity\Stashs;
use App\Entity\Specialitys;
use App\Entity\Targets;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"read:missionsCollection"} }
 * )
 * @ORM\Entity(repositoryClass=MissionsRepository::class)
 */
class Missions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:missionsCollection"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missionsCollection"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:missionsCollection"})
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missionsCollection"})
     */
    private $code_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missionsCollection"})
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:missionsCollection"})
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read:missionsCollection"})
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     * @Groups({"read:missionsCollection"})
     */
    private $end_date;

    /**
     * @ORM\ManyToMany(targetEntity=Specialitys::class, inversedBy="missions")
     *
     */
    private $specialitys;

    /**
     * @ORM\ManyToMany(targetEntity=Agents::class, inversedBy="missions")
     */
    private $agents;

    /**
     * @ORM\ManyToMany(targetEntity=Contacts::class, inversedBy="missions")
     */
    private $contacts;

    /**
     * @ORM\ManyToMany(targetEntity=Targets::class, inversedBy="missions")
     */
    private $targets;

    /**
     * @ORM\ManyToMany(targetEntity=Stashs::class, inversedBy="missions")
     */
    private $stashs;

    

    

    public function __construct()
    {
        $this->specialitys = new ArrayCollection();
        $this->agents = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->targets = new ArrayCollection();
        $this->stashs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->code_name;
    }

    public function setCodeName(string $code_name): self
    {
        $this->code_name = $code_name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection|Specialitys[]
     */
    public function getSpecialitys(): Collection
    {
        return $this->specialitys;
    }

    public function addSpeciality(Specialitys $speciality): self
    {
        if (!$this->specialitys->contains($speciality)) {
            $this->specialitys[] = $speciality;
        }

        return $this;
    }

    public function removeSpeciality(Specialitys $speciality): self
    {
        $this->specialitys->removeElement($speciality);

        return $this;
    }

    /**
     * @return Collection|Agents[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agents $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agents $agent): self
    {
        $this->agents->removeElement($agent);

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contacts $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contacts $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @return Collection|Targets[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Targets $target): self
    {
        if (!$this->targets->contains($target)) {
            $this->targets[] = $target;
        }

        return $this;
    }

    public function removeTarget(Targets $target): self
    {
        $this->targets->removeElement($target);

        return $this;
    }

    /**
     * @return Collection|Stashs[]
     */
    public function getStashs(): Collection
    {
        return $this->stashs;
    }

    public function addStash(Stashs $stash): self
    {
        if (!$this->stashs->contains($stash)) {
            $this->stashs[] = $stash;
        }

        return $this;
    }

    public function removeStash(Stashs $stash): self
    {
        $this->stashs->removeElement($stash);

        return $this;
    }

    

 
}
